FROM 6bdocker/base-app-dashboard:apache-ubuntu-jammy-php-8.1
ARG WWWGROUP
ARG COMPOSER_KEY

#Create upload folders
VOLUME /var/www/html/public/mac/files /var/www/html/public/pdf/pdfs /var/www/html/public/img/sig /var/www/html/public/img/qr

#Remove base Configs that not used in this custom setup
RUN rm -r /var/www/app-configs/

#Copy site files to webroot folder
RUN chown docker /var/www/html/public
COPY --chown=docker:staff . /var/www/html/public

#copy all configuration files
COPY --chown=docker:staff ./docker/configs/*.php /var/www/html/public/configs/

#SET Config(s) to readonly
RUN chmod -w /var/www/html/public/configs/

#Set docker working folder to webroot
WORKDIR /var/www/html

#Make all web files be owned by docker
#RUN chown -R docker /var/www/html

############## DEPENDENCIES via COMPOSER ###################
# Get dependencies
USER docker
# Only add private composer if COMPOSER_KEY is provided else ignore
RUN if [ ! -z "$COMPOSER_KEY" ]; then echo "Install Key :: ${COMPOSER_KEY}" & composer config --global --auth http-basic.repo.packagist.com 6bdigital $COMPOSER_KEY; else echo "NO Key Found"; fi
#Only run composer on the themes and if they have a composer.json file
#Fix lock file been in this repo
RUN if [ -f "/var/www/html/public/classes/composer.lock" ]; then rm /var/www/html/public/classes/composer.lock; fi
RUN if [ -f "/var/www/html/public/classes/composer.json" ]; then composer install --no-dev --working-dir=/var/www/html/public/classes; fi
#Fix lock file been in this repo
RUN if [ -f "/var/www/html/public/connector/composer.lock" ]; then rm /var/www/html/public/connector/composer.lock; fi
RUN if [ -f "/var/www/html/public/connector/composer.json" ]; then composer install --no-dev --working-dir=/var/www/html/public/connector; fi
USER root


##### START SERVER
#Copy scripts needed to run the docker image
COPY docker/custom-entrypoint.sh /
RUN chmod +x /custom-entrypoint.sh

#Remove the docker folder after used, no longer needed in the root of the site
RUN rm -r /var/www/html/public/docker

# Needed for M1 mac
# RUN echo "Mutex posixsem" >> /etc/apache2/apache2.conf