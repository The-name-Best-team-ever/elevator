# See https://github.com/docker-library/php/blob/master/7.1/fpm/Dockerfile
FROM php:7.1-fpm
ARG TIMEZONE

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip \
    libicu-dev \
    libxml2-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

# Install intl
#RUN docker-php-ext-configure intl \
#    && docker-php-ext-install \
#        intl \
#    && docker-php-ext-enable intl
#
## install xdebug
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug
#RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_enable = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_autostart = Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_connect_back = Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.profiler_enable = Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_host = $HOST_IP" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.var_display_max_data = 2048" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "xdebug.var_display_max_depth = 10" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#
#RUN echo "short_open_tag = Off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
##RUN echo "xdebug.remotedoc_log = \"/var/log/php7-fpm/xdebug.log\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#
#RUN echo "log_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "error_log = \"/var/log/php7-fpm/error.log\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "upload_max_filesize = 30M" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
#RUN echo "max_execution_time = 600" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www
