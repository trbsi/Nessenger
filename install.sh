#!/bin/bash
while true; do
    read -p "Do you wish to install this program?" yn
    case $yn in
        [Yy]* ) composer install; php artisan key:generate; php artisan migrate:fresh --seed; php artisan search:crud; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done