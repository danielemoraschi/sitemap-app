FROM php:5.6-cli

# Composer
RUN apt-get update
RUN apt-get install -y git-core unzip
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /data
RUN git clone https://github.com/danielemoraschi/sitemap-app.git .
RUN composer install

ENTRYPOINT ["php", "bin/sitemap"]