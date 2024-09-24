FROM php:8.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

ENV TZ=Asia/Jakarta

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install system dependencies
RUN apt-get update && apt-get dist-upgrade -y && \ 
    apt-get install -y \
    git \
    libcurl4-gnutls-dev \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    libpq-dev \
    libgmp-dev \
    vim-nox \
    iputils-ping \
    mariadb-client \
    postgresql-client \
    sudo

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo mysqli pdo_mysql mbstring exif pcntl bcmath gd intl zip pgsql pdo_pgsql curl xml

COPY --from=composer:2.5.5 /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user && echo "$user:$user" | chpasswd && adduser $user sudo
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# Set working directory
WORKDIR /var/www

USER $user
