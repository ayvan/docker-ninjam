# Dockerfile and configs for ninjam server

What is NINJAM server? Please, read this first:

https://www.reddit.com/r/Guitar/comments/butxrs/discussion_online_jamming_everything_you_ever/

This set of configs, scripts and dockerfiles created to start you NINJAM server fast and easy.
You can get VPS/VDS Linux server in Hetzner or another hosting provider, install Docker and start
you NINJAM server in ~1 hour!

## Other repos used in this project

Chat bot for cross-chats communication (by default only between two ninjam servers):

https://github.com/ayvan/ninjam-chatbot

DJ bot for queue management and tracks management:

https://github.com/ayvan/ninjam-dj-bot

DJ bot can manage tracks and playlists: you can upload .mp3 tracks (guitar backing tracks) to DJ bot, and start it using
DJ bot chat commands, for example "dj random", or "dj random Am" for random Am backing track. Also it supports playlists. 

API documentation for DJ bot:

https://github.com/ayvan/ninjam-dj-bot/tree/master/api


## How to start

Get sources:
```bash
$ git clone https://github.com/Ayvan/docker-ninjam.git
$ cd docker-ninjam
```

Generate new passwords:
```bash
$ ./passwords.sh
```

After generating, this script prints passwords to console. Please, save you passwords in secure place.

Set your server hostname and email for Let's Encrypt request:
```bash
$ ./hostname.sh YOURSERVER.COM YOUR-EMAIL@SOMEMAIL.COM
```

Generate RSA keys for JWT token authentication (for DJ bot API) manually or run script:
```bash
$ ./jwt_rsa_keys.sh
```

RSA keys must be placed in /etc/ninjam directory and file names must be private.pem and public.pem

Create user dj, and user home dir, and tracks dir:
```
useradd dj && mkdir /home/dj && chown dj:dj /home/dj && mkdir /home/dj/tracks && chown dj:dj /home/dj/tracks
```

Copy configs and web files (for example, you can use another path to configs, but you need to change it in start command too):
```bash
$ sudo cp -R icecast2 /etc/icecast2
$ sudo cp -R ninjam /etc/ninjam
$ sudo cp -R ninjam-web /var/www/ninjam-web
```

You can edit your configs and web files manually. For example, you can update HTML in index.php file
(change favicon.ico, page logo or any text on page), add new users in ninjam2050.cfg and ninjam2051.cfg files etc. 

Build docker container:
```bash
$ ./build.sh
```

Start:
```bash
$ /usr/bin/docker run -t -a stdout --rm -p 80:80 -p 443:443 -p 2050:2050 -p 2051:2051 -p 8000:8000 -v /home/dj/tracks:/home/dj/tracks -v /etc/ninjam:/etc/ninjam -v /etc/icecast2:/etc/icecast2 -v /var/www/ninjam-web:/app/src/public ninjam-server:latest
```

To autostart server you can use supervisord config file jam.conf


### If you want to connect to the docker container:

First:
```bash
$ docker ps

```

response:
```
CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                                                                                                          NAMES
f153d46ca7ce        ninjam-server:latest   "/bin/sh -c /etc/rc.…"   4 minutes ago       Up 4 minutes        0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp, 0.0.0.0:2050-2051->2050-2051/tcp, 0.0.0.0:8000->8000/tcp, 9000/tcp   xenodochial_heyrovsky
```

Second: get CONTAINER ID from response above and insert to this command:
```bash
$ docker exec -it f153d46ca7ce /bin/bash
```

### How to enable HTTPS?

HTTPS is automatically enabled. Just set your email and domain for Let's Encrypt by hostname.sh script, and it automatically generates certificate for HTTPS.