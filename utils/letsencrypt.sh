#!/bin/bash

certbot certonly -d HOSTNAME -d www.HOSTNAME -n  --agree-tos --webroot -w /app/src/public