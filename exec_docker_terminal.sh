#!/bin/bash
id=$(docker ps | sed -n 's/^\([0-9a-f]\+\)\s\+ninjam-server.*/\1/p')
docker exec -it $id /bin/bash
