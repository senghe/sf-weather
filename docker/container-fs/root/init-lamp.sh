#!/usr/bin/env bash

set-env-vars.sh
setup-xdebug.sh
source /etc/profile

# Start servers
rm /etc/apache2/sites-enabled/000-default.conf

/etc/init.d/apache2 start
/etc/init.d/php7.1-fpm start

echo "Waiting for MySQL (Ctrl+C to break)"
while ! mysqladmin ping -h"${ENV__DATABASE__HOST}" --silent; do
    sleep 1
done

mkdir -p /var/www/weather/var

echo "All operations done. Now you can start developing :)"

# Docker container lives until the main process ends
while true; do sleep 1000; done
