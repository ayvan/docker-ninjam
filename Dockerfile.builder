# prepare build image
FROM ubuntu:16.04 as builder
MAINTAINER Ivan Korostelev <ajvan.ivan@gmail.com>

ENV GOPATH /go
ENV PATH $GOPATH/bin:/usr/local/go/bin:$PATH
RUN mkdir -p "$GOPATH/src" "$GOPATH/bin" && chmod -R 777 "$GOPATH"

RUN apt update && \
    apt install -y \
        wget git make gcc g++ \
        sox libsox-fmt-mp3 libsoxr-dev \
        liblilv-dev \
        lib32ncurses5 lib32ncurses5-dev \
        libasound2 libasound2-dev \
        libvorbis-dev libvorbis0a \
        libvorbisenc2 libogg-dev \
        libmp3lame-dev libjack-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    wget -P /tmp https://dl.google.com/go/go1.11.5.linux-amd64.tar.gz && \
    tar -C /usr/local -xzf /tmp/go1.11.5.linux-amd64.tar.gz && \
    rm /tmp/go1.11.5.linux-amd64.tar.gz
