FROM ubuntu:17.10

# Set the locale
RUN apt-get clean && apt-get update && apt-get install -y locales
RUN locale-gen en_US.UTF-8

ENV LANG                                   en_US.UTF-8
ENV LANGUAGE                               en_US:en
ENV LC_ALL                                 en_US.UTF-8

# Update packages
RUN DEBIAN_FRONTEND=noninteractive \
    apt-get -y --force-yes update


# Environment
RUN DEBIAN_FRONTEND=noninteractive \
    apt-get -y --force-yes update && \
    apt-get -y --force-yes install vim \
    sudo \
    mlocate \
    lsof


# Unofficial PHP7.1 repository
RUN DEBIAN_FRONTEND=noninteractive \
    apt-get -y --force-yes update && \
    apt-get -y --force-yes install software-properties-common && \
    apt-get -y --force-yes install python-software-properties && \
    add-apt-repository -y ppa:ondrej/php


# Apache, PHP and other dependencies
RUN DEBIAN_FRONTEND=noninteractive \
    apt-get -y --force-yes update && \
    apt-get -y --force-yes install \
    apache2 \
    libapache2-mod-php7.1 \
    php7.1 \
    php7.1-fpm \
    php7.1-gd \
    php7.1-mysql \
    php7.1-curl \
    php7.1-cli \
    php7.1-intl \
    php7.1-common \
    php7.1-sqlite \
    php7.1-dom \
    php7.1-simplexml \
    php7.1-xmlwriter \
    php7.1-mbstring \
    php7.1-mcrypt \
    php7.1-dev \
    php7.1-bcmath \
    php7.1-zip \
    php7.1-soap \
    php7.1-xdebug \
    php-apcu \
    php-xdebug \
    php-pear \
    php-oauth \
    sudo \
    supervisor \
    iproute2 \
    git \
    build-essential

RUN DEBIAN_FRONTEND=noninteractive \
    apt-get -y --force-yes update && \
        apt-get -y --force-yes install \
        mysql-client

RUN pear install SOAP-0.13.0 Mail

# Settings
ENV USER_UID                        1000
ENV USER_GID                        1000

ENV ENV__DATABASE__HOST            weather_mariadb
ENV ENV__DATABASE__USER            root
ENV ENV__DATABASE__PASSWORD        password
ENV ENV__DATABASE__PORT            3306

VOLUME /var/www/weather/

RUN a2enmod rewrite headers

# Do not use chmod or setfacl with user weather beacuse UID and GID for this user will change on container startup!
RUN groupadd -g $USER_GID weather && \
    useradd --create-home --shell /bin/bash -u $USER_UID -g $USER_GID weather


RUN sed -e 's/;clear_env = no/clear_env = no/' -i /etc/php/7.1/fpm/pool.d/www.conf

# Composer
ENV COMPOSER_HOME /usr/local/composer
ENV PATH /usr/local/composer/vendor/bin:$PATH

RUN echo "export COMPOSER_HOME=/usr/local/composer" >> /etc/profile.d/composer.sh && \
    echo "export PATH=/usr/local/composer/vendor/bin:\$PATH" >> /etc/profile.d/path.sh

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && chmod 755 /usr/local/bin/composer

RUN groupadd composer && usermod -a -G composer weather && \
    chown weather:composer $COMPOSER_HOME && \
    chown weather:composer $COMPOSER_HOME -R && \
    chmod 775 $COMPOSER_HOME && \
    chmod 775 $COMPOSER_HOME -R && \
    ln -fs /usr/share/zoneinfo/Europe/Warsaw /etc/localtime && dpkg-reconfigure -f noninteractive tzdata && \
    sudo mkdir -p /var/www/weather/var/cache && \
    sudo mkdir -p /var/www/weather/var/logs && \
    sudo mkdir -p /var/www/weather/var/sessions && \
    sudo chmod -R 777 /var/www/weather/var

# Scripts
COPY container-fs /

RUN chmod u+x /root/scripts -R && \
    chmod u+x /root/init-lamp.sh -R

ENV PATH /root/scripts:$PATH
RUN echo "export PATH=/root/scripts:\$PATH" >> /etc/profile.d/path.sh

CMD ["/root/init-lamp.sh"]
