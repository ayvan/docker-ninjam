#!/bin/bash

certbot certonly -d HOSTNAME -d www.HOSTNAME -n  --agree-tos --standalone --email HOSTEMAIL
cp /etc/letsencrypt/live/HOSTNAME/privkey.pem /etc/ninjam/
cp /etc/letsencrypt/live/HOSTNAME/fullchain.pem /etc/ninjam/
/etc/init.d/nginx reload