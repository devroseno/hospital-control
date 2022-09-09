FROM php:8.1-fpm

RUN apt update && apt install -y \
  libpng-dev \
  libpq-dev \
  glibc-source \
  zlib1g-dev \
  libxml2-dev \
  libzip-dev \
  libonig-dev \
  libicu-dev \
  zip \
  curl \
  wget \
  unzip \
  nano \
  htop \
  rsync \
  openssl \
  cron \
  supervisor \
  git \
  && docker-php-ext-configure gd \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-install pdo_pgsql \
  && docker-php-ext-install pdo \
  && docker-php-ext-install pdo_mysql \
  && docker-php-ext-install pgsql \
  && docker-php-ext-install exif \
  && docker-php-ext-install zip \
  && docker-php-source delete \
  && docker-php-ext-install opcache \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

# Clean cahe
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt autoremove -y

# Download Composer Files
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# Creating folders for the project
RUN mkdir -p /home/LogFiles/ \
    && echo "cd /var/www/" >> /etc/bash.bashrc
    

WORKDIR /var/www

EXPOSE 9000

CMD [ "php-fpm" ]