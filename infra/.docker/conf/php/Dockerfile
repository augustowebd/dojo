FROM php:7.3.5-cli-stretch

RUN set -eux; \
    apt-get update;                                                 \
    apt-get install -y libpq-dev                                    \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql  \
    && docker-php-ext-install pdo pdo_pgsql pgsql;                  \
    rm -rf /var/lib/apt/lists/*

RUN pecl install -o -f redis        \
    &&  rm -rf /tmp/pear            \
    &&  docker-php-ext-enable redis

CMD ["-"]

ENTRYPOINT ["php"]
