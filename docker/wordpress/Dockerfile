FROM wordpress:fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
    && docker-php-ext-install -j$(nproc) mbstring exif
