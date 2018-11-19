#!/bin/bash

# bash generate random 16 character alphanumeric string (upper and lowercase) and
NEW_PASSWORD=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c16)
NEW_ADMIN_PASSWORD=$(head /dev/urandom | tr -dc A-Za-z0-9 | head -c16)

sed -i "s/CHANGEPASSWORD/$NEW_PASSWORD/g" ./*.conf ./*/*.cfg ./*/*.xml ./*/*.yaml
sed -i "s/ADMINPASSWORD/$NEW_ADMIN_PASSWORD/g" ./*.conf ./*/*.cfg ./*/*.xml ./*/*.yaml

echo "Your admin name for jamserver is Admin, password" $NEW_ADMIN_PASSWORD