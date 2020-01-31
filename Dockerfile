# prepare build image
FROM ubuntu:16.04 as builder

RUN apt update && \
    apt install -y \
        wget git make gcc g++ \
        sox libsox-fmt-mp3 \
        liblilv-dev \
        lib32ncurses5 lib32ncurses5-dev \
        libasound2 libasound2-dev \
        libvorbis-dev libvorbis0a \
        libvorbisenc2 libogg-dev \
        libmp3lame-dev libjack-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN wget -P /tmp https://dl.google.com/go/go1.11.5.linux-amd64.tar.gz && \
    tar -C /usr/local -xzf /tmp/go1.11.5.linux-amd64.tar.gz && \
    rm /tmp/go1.11.5.linux-amd64.tar.gz

ENV GOPATH /go
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
RUN mkdir -p "$GOPATH/src" "$GOPATH/bin" && chmod -R 777 "$GOPATH"

FROM builder as build-ninjamsrv
WORKDIR /

# get sources and build ninjam server and ninjamcast
RUN git clone https://github.com/justinfrankel/ninjam && \
    git clone https://github.com/ayvan/ninjamcast && \
    # build ninjamsrv
    cd /ninjam/ninjam/server && \
    make && \
    # build ninjamcast
    cd /ninjamcast/ninjam/ninjamcast && \
    make

FROM builder as build-ninjambots
# get sources and build go applications
RUN go get github.com/ayvan/ninjam-chatbot github.com/ayvan/ninjam-dj-bot && \
    cd $GOPATH/src/github.com/ayvan/ninjam-chatbot && \
    CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build -a -installsuffix cgo -ldflags "-s -w" -o /bin/ninjam-chatbot && \
    cd $GOPATH/src/github.com/ayvan/ninjam-dj-bot && \
    cp lv2host.yaml /etc/lv2host.yaml && \
    CGO_ENABLED=1 GOOS=linux GOARCH=amd64 go build -a -installsuffix cgo -ldflags "-s -w" -o /bin/ninjam-dj-bot && \
    cd $GOPATH/src/github.com/ayvan/ && \
    rm -rf $GOPATH/src/

# prepare application server
FROM justckr/ubuntu-nginx-php:latest AS ubuntu-server

RUN apt update && \
    apt install -y \
        apt-transport-https software-properties-common \
        libglibmm-2.4-1v5 \
        certbot logrotate && \
    curl -sL -o kxstudio-repos_9.5.1~kxstudio3_all.deb https://launchpad.net/~kxstudio-debian/+archive/kxstudio/+files/kxstudio-repos_9.5.1~kxstudio3_all.deb && \
    curl -sL -o kxstudio-repos-gcc5_9.5.1~kxstudio3_all.deb https://launchpad.net/~kxstudio-debian/+archive/kxstudio/+files/kxstudio-repos-gcc5_9.5.1~kxstudio3_all.deb && \
    dpkg -i kxstudio-repos_9.5.1~kxstudio3_all.deb && \
    dpkg -i kxstudio-repos-gcc5_9.5.1~kxstudio3_all.deb && \
    apt update && \
    apt install -y \
        icecast2 \
        x42-plugins calf-plugins \
        libvorbis-dev sox libsox-fmt-mp3 \
        bs1770gain liblilv-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    mkdir /var/log/ninjam && \
    chmod +x /etc/rc.local && \
    useradd dj && \
    mkdir /home/dj && \
    chown dj:dj /home/dj && \
    sed -i 's/daemon on/daemon off/g' /etc/nginx/nginx.conf && \
    sed -i 's/ENABLE=false/ENABLE=true/g' /etc/default/icecast2 && \
    ln -s /etc/ninjam/letsencrypt.sh /etc/cron.weekly/letsencrypt

FROM ubuntu-server AS jamserver
MAINTAINER Ivan Korostelev <ajvan.ivan@gmail.com>

COPY --from=build-ninjambots /bin/ninjam-chatbot /usr/bin/ninjam-chatbot
COPY --from=build-ninjambots /bin/ninjam-dj-bot /usr/bin/ninjam-dj-bot
COPY --from=build-ninjambots /etc/lv2host.yaml /etc/lv2host.yaml
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv2
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast2

COPY ./etc/rc.local /etc/rc.local
COPY ./etc/default.https.conf /etc/nginx/sites-available/default.conf
COPY ./etc/acme-challenge.conf /etc/nginx/acme-challenge.conf
COPY ./etc/ninjam-supervisor.conf /etc/supervisor/conf.d/ninjam.conf
COPY ./etc/logrotate.d /etc/logrotate.d


ENTRYPOINT /etc/rc.local

# expose HTTP
EXPOSE 80 2050 2051 443