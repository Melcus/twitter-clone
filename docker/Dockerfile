FROM ubuntu:18.04

ENV TERM=xterm\
    TZ=Europe/Bucharest\
    DEBIAN_FRONTEND=noninteractive\
    LANG=C.UTF-8\
    PYTHONUNBUFFERED=1

COPY ./docker/docker-cache-workaround /tmp/docker-cache-workaround

EXPOSE 80

RUN apt-get clean && apt-get -y update && apt-get install -y locales curl software-properties-common git \
    && apt purge -y unattended-upgrades \
    && locale-gen de_DE.UTF-8 \
    && LC_ALL=de_DE.UTF-8 add-apt-repository ppa:ondrej/php \
    && apt-get -y update \
    && usermod -u 1000 www-data\
    && groupmod -g 1000 www-data\
    && apt-get update -qq\
    && apt-get install -qqy php7.4\
                            php7.4-cli\
                            php-imagick\
                            php-redis\
                            php7.4-curl\
                            php7.4-fpm\
                            php7.4-gd\
                            php7.4-gmp\
                            php7.4-intl\
                            php7.4-mbstring\
                            php7.4-mysqli\
                            php7.4-soap\
                            php7.4-xml\
                            php7.4-zip\
                            php7.4-opcache\
                            cron\
                            curl\
                            git-core\
                            graphicsmagick\
			                imagemagick\
                            mysql-client\
                            nginx\
                            redis-tools\
                            since\
                            ssmtp\
                            supervisor\
                            vim.tiny\
                            wget\
                            unzip\
    && apt-get install -qqy --no-install-recommends\
                            python-pip\
                            python-setuptools\
                            python-wheel\
    && apt-get clean\
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*\
    && pip install supervisor-stdout\
    && phpenmod mysqli\
    && wget --quiet -O /usr/bin/composer https://getcomposer.org/composer.phar\
    && chmod 0755 /usr/bin/composer\
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime\
    && echo $TZ > /etc/timezone\
    \
    && mkdir -p /var/www/

ADD ./docker/conf /etc/conf

RUN ln -s /etc/conf/php/90-application.ini /etc/php/7.4/fpm/conf.d/\
    && ln -s /etc/conf/php/90-application.ini /etc/php/7.4/cli/conf.d/\
    && ln -s /etc/conf/php/fpm-application.conf /etc/php/7.4/fpm/pool.d/application.conf\
    && ln -sf /etc/conf/php/fpm-www.conf /etc/php/7.4/fpm/pool.d/www.conf\
    \
    && ln -s /etc/conf/nginx/site-application /etc/nginx/sites-enabled/application\
    && rm /etc/nginx/sites-enabled/default\
    && mv /etc/nginx/nginx.conf /etc/nginx/default-nginx.conf\
    && ln -s /etc/conf/nginx/nginx.conf /etc/nginx/\
    && ln -s /etc/conf/nginx/fastcgi_params-extra /etc/nginx/\
    \
    && touch /var/log/cron.log\
    && chown www-data /var/log/cron.log\
    && cp -r /etc/conf/cron/* /etc/cron.d/\
    && cp /etc/conf/sendmail/sendmail.php /usr/sbin/sendmail\
    && chmod +x /usr/sbin/sendmail\
    \
    && chmod +x /etc/conf/start.sh\
    \
    && ln -sf /etc/conf/supervisor/supervisord.conf /etc/supervisor/\
    && ln -s /etc/conf/supervisor/conf.d/* /etc/supervisor/conf.d/\
    && mkdir -p /run/php/\
    \
    && echo '. /etc/conf/bash.colorprompt' >> /etc/bash.bashrc\
    && echo '. /etc/conf/bash.colorprompt' >> /root/.bashrc

# Install the app
#ADD ./src /var/www/application
#RUN chown -R www-data:www-data /var/www

# Install the app
#COPY --chown=www-data:www-data src /var/www/application

VOLUME ["/var/www/application"]

WORKDIR /var/www/application

CMD ["/etc/conf/start.sh"]
