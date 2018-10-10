#!/usr/bin/env bash

red=$'\e[1;31m'
grn=$'\e[1;32m'
blu=$'\e[1;34m'
mag=$'\e[1;35m'
cyn=$'\e[1;36m'
white=$'\e[0m'

sudo apt update
sudo apt install -y curl

echo " $red ----- Installing Pre requisites ------- $white "

sudo apt install -y docker.io
sudo systemctl start docker
sudo systemctl enable docker

sudo curl -L "https://github.com/docker/compose/releases/download/1.22.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose

docker-compose down && docker-compose up -d

echo " $red ----- Running tests ------- $white "
docker exec delivery_php php ./vendor/phpunit/phpunit/phpunit tests/testOrder.php

exit 0
