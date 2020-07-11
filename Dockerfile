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
    cp lv2speech.yaml /etc/lv2speech.yaml && \
    CGO_ENABLED=1 GOOS=linux GOARCH=amd64 go build -a -installsuffix cgo -ldflags "-s -w" -o /bin/ninjam-dj-bot && \
    cd $GOPATH/src/github.com/ayvan/ && \
    rm -rf $GOPATH/src/

FROM ubuntu-server AS jamserver
MAINTAINER Ivan Korostelev <ajvan.ivan@gmail.com>

COPY --from=build-ninjambots /bin/ninjam-chatbot /usr/bin/ninjam-chatbot
COPY --from=build-ninjambots /bin/ninjam-dj-bot /usr/bin/ninjam-dj-bot
COPY --from=build-ninjambots /etc/lv2host.yaml /etc/lv2host.yaml
COPY --from=build-ninjambots /etc/lv2speech.yaml /etc/lv2speech.yaml
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv2
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast2

COPY ./etc/rc.local /etc/rc.local
COPY ./etc/default.https.conf /etc/nginx/sites-available/default.conf
COPY ./etc/ninjam-supervisor.conf /etc/supervisor/conf.d/ninjam.conf
COPY ./etc/logrotate.d /etc/logrotate.d

ENTRYPOINT /etc/rc.local

# expose HTTP
EXPOSE 80 2050 2051 443