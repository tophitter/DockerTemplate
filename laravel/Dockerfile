FROM 6bdocker/base-app-laravel:apache-ubuntu-jammy-9

ARG COMPOSER_KEY

# Copy site files to webroot folder
RUN chown docker /var/www/html
COPY --chown=docker:staff . /var/www/html

# Set docker working folder to webroot
WORKDIR /var/www/html

# Copy all configuration files
COPY --chown=docker:staff docker/docker.env /var/www/html/.env

# Set flags on folders and allow execute of artisan commands
RUN chown -h docker "/var/www/html/storage/" && chmod +x /var/www/html/artisan  && echo "Finished setting up application in /var/www/html"

############## DEPENDENCIES via COMPOSER ###################
# Get dependencies
USER docker
# Only add private composer if COMPOSER_KEY is provided else ignore
RUN if [ ! -z "$COMPOSER_KEY" ]; then echo "Install Key :: ${COMPOSER_KEY}" & composer config --global --auth http-basic.repo.packagist.com 6bdigital $COMPOSER_KEY; else echo "NO Key Found"; fi
#Only run composer on the themes and if they have a composer.json file
RUN if [ -f "/var/www/html/composer.json" ]; then composer install --no-dev --working-dir=/var/www/html; fi
USER root

############## DEPENDENCIES via COMPOSER ###################

##### START SERVER #####
COPY docker/custom-entrypoint.sh /
RUN chmod +x /custom-entrypoint.sh

# Remove the docker folder after used, no longer needed in the root of the site
RUN if [ -d "/var/www/html/docker" ]; then rm -Rf /var/www/html/docker; fi

##### START SERVER #####