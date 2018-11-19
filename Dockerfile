FROM golang:1.11-alpine AS build

# Install tools required for project
# Run `docker build --no-cache .` to update dependencies
RUN apk add --no-cache git make g++

RUN go get github.com/Ayvan/ninjam-chatbot
WORKDIR /go/src/github.com/Ayvan/ninjam-chatbot
RUN go install
RUN CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build -a -installsuffix cgo -ldflags "-s -w" -o /bin/ninjam-chatbot

RUN go get github.com/Ayvan/ninjam-dj-bot
WORKDIR /go/src/github.com/Ayvan/ninjam-dj-bot
RUN go install
RUN CGO_ENABLED=0 GOOS=linux GOARCH=amd64 go build -a -installsuffix cgo -ldflags "-s -w" -o /bin/ninjam-dj-bot

# build ninjamsrv
FROM ubuntu:16.04 as build-ninjamsrv

RUN apt update && \
        apt install -y \
	git make g++ \
	lib32ncurses5 lib32ncurses5-dev \
	libasound2 libasound2-dev \
	libvorbis-dev libvorbis0a \
	libvorbisenc2 libogg-dev \
	libmp3lame-dev libjack-dev

WORKDIR /

# get ninjam sources
RUN git clone https://github.com/justinfrankel/ninjam

WORKDIR /ninjam/ninjam/server

# build ninjamsrv
RUN make

# build curses client
WORKDIR /ninjam/ninjam/cursesclient

# build ninjamsrv
RUN make

WORKDIR /

RUN git clone https://github.com/ayvan/ninjamcast

WORKDIR /ninjamcast/ninjam/ninjamcast

RUN make

# This results in a single layer image
FROM justckr/ubuntu-nginx-php:latest
MAINTAINER Ivan Korostelev <ajvan.ivan@gmail.com>

RUN apt update && \
	apt install -y \
	icecast2 php nginx \
	pulseaudio supervisor \
	libmp3lame-dev mpg321

COPY --from=build /bin/ninjam-chatbot /usr/bin/ninjam-chatbot
COPY --from=build /bin/ninjam-dj-bot /usr/bin/ninjam-dj-bot
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv
COPY --from=build-ninjamsrv /ninjam/ninjam/server/ninjamsrv /usr/bin/ninjamsrv2
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast
COPY --from=build-ninjamsrv /ninjamcast/ninjam/ninjamcast/ninjamcast /usr/bin/ninjamcast2
COPY --from=build-ninjamsrv /ninjam/ninjam/cursesclient/cninjam /usr/bin/cninjam

COPY ./rc.local /etc/rc.local
COPY cninjam.conf /etc/supervisor/conf.d/cninjam.conf

RUN mkdir /var/log/ninjam
RUN chmod +x /etc/rc.local && useradd dj && mkdir /home/dj && chown dj:dj /home/dj
RUN sed -i 's/daemon on/daemon off/g' /etc/nginx/nginx.conf
RUN sed -i 's/ENABLE=false/ENABLE=true/g' /etc/default/icecast2

ENTRYPOINT /etc/rc.local

# expose HTTP
EXPOSE 80 2050 2051 8000