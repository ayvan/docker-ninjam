#Dockerfile and configs for ninjam server

## How to start

Get sources:
```bash
git clone https://github.com/Ayvan/docker-ninjam.git
cd docker-ninjam
```

Generate new passwords:
```bash
./passwords.sh
```

Set your server hostname:
```bash
./hostname.sh YOURSERVER.COM
```

Copy configs and web files (for example, you can use another path to configs, but you need to change it in start command too):
```bash
sudo cp -R icecast2 /etc/icecast2
sudo cp -R ninjam /etc/ninjam
sudo cp -R ninjam-web /var/www/ninjam-web
```

Build docker container:
```bash
./build.sh
```

or
```bash
docker build -t ninjam-server .
```

Start:
```bash
/usr/bin/docker run -t -a stdout --rm -p 80:80 -p 2050:2050 -p 2051:2051 -p 8000:8000 -v /home/dj/tracks:/home/dj/tracks -v /etc/ninjam:/etc/ninjam -v /etc/icecast2:/etc/icecast2 -v /var/www/ninjam-web:/app/src/public ninjam-server:latest
```

To autostart server you can use supervisord config file jam.conf