#!/bin/bash

# Vendor files published
php artisan vendor:publish --tag=public --force

# Clear system cache
php artisan optimize:clear

# Generate API docs
php artisan scribe:generate