#!/usr/bin/env bash

# IP address Can find using `ipconfig getifaddr en0` or `ipconfig getifaddr en1` on host machine
# OR check it inside container system using `/sbin/ip route|awk '/default/ { print $3 }'`

PHP_XDEBUG_REMOTE_ADDRESS="$(/sbin/ip route|awk '/default/ { print $3 }')"
sed 's@xdebug.remote_host=@xdebug.remote_host='"$PHP_XDEBUG_REMOTE_ADDRESS"'@g' /etc/php/7.1/mods-available/xdebug.ini
