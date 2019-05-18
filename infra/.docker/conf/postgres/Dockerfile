# vim:set ft=dockerfile:
FROM postgres:10.1

LABEL author="augustowebd <augustowebd@gmail.com>"
LABEL version="0.0.1"
LABEL description="Postgres && PHP"

# COPY php-ext/redis /tmp

# aqui vamos para a solução mais fácil:
# instalei o PHP-CLI para ele poder executar o script invocado pelo postgres
RUN set -eux;                                                           \
    apt-get update;                                                     \
    apt-get install -y php-cli php-dev php-pdo php-pdo-pgsql php-curl;  \
    pecl install -o -f redis                                            \
    &&  rm -rf /tmp/pear;                                               \
    echo "extension=redis.so" >> /etc/php/7.0/cli/php.ini;              \
    rm -rf /var/lib/apt/lists/*

EXPOSE 5432
CMD ["postgres"]
