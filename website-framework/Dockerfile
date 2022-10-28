FROM 6bdocker/base-app-website-framework:apache-ubuntu-jammy-php-8.1
ARG WWWGROUP
ARG COMPOSER_KEY

#Copy site files to webroot folder
RUN chown docker /var/www/html/public
COPY --chown=docker:staff . /var/www/html/public

#copy all configuration files
COPY --chown=docker:staff ./docker/configs/*.php /var/www/html/public/app/configs/

#SET Config(s) to readonly
RUN chmod -w /var/www/html/public/app/configs/

#Set docker working folder to webroot
WORKDIR /var/www/html

##### START SERVER
#Copy scripts needed to run the docker image
COPY docker/custom-entrypoint.sh /
RUN chmod +x /custom-entrypoint.sh

#Remove the docker folder after used, no longer needed in the root of the site
RUN rm -r /var/www/html/public/docker

# Needed for M1 mac
# RUN echo "Mutex posixsem" >> /etc/apache2/apache2.conf