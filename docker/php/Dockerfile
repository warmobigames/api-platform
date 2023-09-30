FROM php:8.2-fpm
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install zip and unzip
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libcurl4-openssl-dev pkg-config libssl-dev
RUN apt-get upgrade -y
RUN apt-get install zip unzip -y


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install postgresql driver
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql

RUN pecl install mongodb apcu && docker-php-ext-enable mongodb apcu opcache

WORKDIR "/py"
RUN apt install -y python3 python3-pip
RUN apt install -y python3-torch
RUN apt install -y python3-torchaudio
RUN apt install -y python3-numpy
RUN apt-get install libportaudio2 -y
RUN apt install -y python3-boto3
RUN apt install -y python3-click
RUN apt install -y python3-omegaconf
RUN apt install -y wget
RUN apt install -y tar
RUN wget https://files.pythonhosted.org/packages/18/dd/e617cfc3f6210ae183374cd9f6a26b20514bbb5a792af97949c5aacddf0f/argparse-1.4.0.tar.gz
RUN tar xvzf argparse-1.4.0.tar.gz
WORKDIR "/py/argparse-1.4.0"
RUN python3 setup.py build
RUN python3 setup.py install
