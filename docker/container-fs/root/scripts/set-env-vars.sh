#!/usr/bin/env bash

echo "> Reloading environment variables"

# Set PHP_ environment variables for all users
mkdir -p /etc/profile.d
echo "" > /etc/profile.d/environment.sh

touch /etc/apache2/php_env
touch /etc/apache2/envvars

printenv | while read -r line ; do
    if [[ $line == PHP_* ]]; then
        echo "SetEnv $line" >> /etc/apache2/php_env
        echo "export $line" >> /etc/apache2/envvars
    fi
done
sed -i -e 's/=/ /g' /etc/apache2/php_env
