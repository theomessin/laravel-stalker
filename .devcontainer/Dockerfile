# From official php image.
FROM php:7.2-cli-alpine
# Install the php zip extension.
RUN apk add --no-cache libzip-dev && docker-php-ext-configure zip && docker-php-ext-install zip
# Install php pcov pecl extension for super-fast coverage reports.
RUN apk add --no-cache g++ gcc make php7-dev zlib-dev && pecl install pcov && docker-php-ext-enable pcov
# Install composer for php deps.
RUN apk add --no-cache composer
# Install quality-of-life packages.
RUN apk add --no-cache bash curl git vim wget
# Create a vscoder user group and user account.
RUN addgroup -g 1000 -S vscoder && adduser -u 1000 -S vscoder -G vscoder
# Copy the .bashrc file for vscoder.
COPY .bashrc /home/vscoder/.bashrc
# Run the workspace till we die.
CMD ["sleep", "infinity"]
