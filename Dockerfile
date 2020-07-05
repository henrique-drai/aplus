FROM fc51606/our-php-7.4

RUN mkdir -p /bin
RUN curl -sS https://getcomposer.org/installer | php 
RUN mv composer.phar /bin/composer
RUN composer require twig/twig
RUN composer require aws/aws-sdk-php
RUN apt-get clean 
RUN a2enmod rewrite
#COPY src/ /var/www/html/
COPY ./ /var/www/html/
RUN service apache2 restart
#RUN /bin/composer install --no-dev --prefer-source
EXPOSE 80
EXPOSE 443