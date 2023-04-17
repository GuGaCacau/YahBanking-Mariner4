# YahBanking-Mariner4
Desafio Técnico YahP - Processo Seletivo 03-2023

Criação:
curl -s https://laravel.build/example-app | bash

Sail: 
docker run --rm
-u "$(id -u):$(id -g)"
-v $(pwd):/var/www/html
-w /var/www/html
laravelsail/php82-composer:latest
composer install --ignore-platform-reqs
