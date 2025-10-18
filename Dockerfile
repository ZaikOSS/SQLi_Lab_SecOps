# Use PHP 7.4 with Apache
FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli
