# Use php 8.2 fpm image
FROM php:8.2-fpm

# Set working directory to /var/www/html
WORKDIR /var/www/html

# Install the necessary software and utilities
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    git \
    zip \
    unzip \
    ffmpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js 18
# For CentOS
# RUN curl -sL https://rpm.nodesource.com/setup_18.x | bash -
# RUN yum install -y nodejs

# For Ubuntu
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Increase the PHP-FPM upload limits
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/uploads.ini
RUN echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/uploads.ini

# Define username and UID in the container
ARG UID=1000
ARG GID=1000

# Create /.npm directory
RUN mkdir /.npm && chown -R ${UID:-1000}:${GID:-1000} "/.npm"

# UID and GID can be passed from environment or default to 1000
RUN groupadd -g ${GID:-1000} groupdev && useradd -u ${UID:-1000} -g ${GID:-1000} -m userdev

# Switch to the specified user with UID and GID
USER userdev

# Expose port 9000 to be able to connect to nginx
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
