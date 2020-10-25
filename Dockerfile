FROM php:7.4-fpm-alpine

# Change user to root for install dependencies
USER root

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apk add --no-cache --update \
    curl \
    git \
    zip \
    unzip

# Install Xdebug
RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.0.0beta1 \
    && docker-php-ext-enable xdebug; exit 0

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory contents
COPY . /var/www

# TODO: Change permissions to www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
