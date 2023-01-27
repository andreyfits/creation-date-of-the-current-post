ARG WORDPRESS_VERSION
ARG PHP_VERSION

FROM wordpress:${WORDPRESS_VERSION}-php${PHP_VERSION}-fpm
ARG PROJECT_FILES

RUN apt-get update && apt-get install -y \
        libcurl4-openssl-dev \
        libzip-dev \
        unzip \
        git \
        zip

RUN docker-php-ext-install pdo pdo_mysql curl zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN set -ex; \
	curl -O "https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar"; \
	chmod +x wp-cli.phar; \
    mv wp-cli.phar /usr/local/bin/wp

ARG USER_ID=0
RUN groupadd -r appuser
RUN useradd -r -u ${USER_ID} -g appuser appuser

USER appuser

WORKDIR ${PROJECT_FILES}

CMD ["php-fpm"]