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
<h1 align="center">
  YahBanking-Mariner4
  <br>
</h1>

<h4 align="center">Desafio Técnico YahP - Processo Seletivo 03-2023</h4>

<p align="center">
  <a href="#descrição">Descrição</a> •
  <a href="#como-utilizar">Como Utilizar</a> •
</p>

## Descrição

Sistema de gestão de contas de clientes e investimentos utilizando o framework Laravel (https://laravel.com/) e ambiente de desenvolvimento Docker e Docker Compose (https://www.docker.com).

A interação entre o Laravel e Docker foi feita utilizando Laravel Sail (https://laravel.com/docs/10.x/sail), facilitando o teste da aplicação com apenas algumas linhas de comando.

A aplicação foi desenvolvido no sistema operacional Windows, rodando o subsistema WSL-2 para utilizar o Ubuntu na máquina e o Visual Studio Code (https://code.visualstudio.com) para a edição de texto.

## Como Utilizar

Para rodar a aplicação, deve-se utilizar os seguintes comandos no terminal WSL/Ubuntu:

```bash
# Clonando o repositório
$ git clone https://github.com/GuGaCacau/YahBanking-Mariner4

# Entrando na pasta da aplicação
$ cd YahBanking-Mariner4

# Instalando dependências do Composer por ser uma aplicação já existente
$ docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Set do .env da Aplicação
$ cp .env.example .env

# Sail da Aplicação (Instalação e Launch das Imagens)
$ ./vendor/bin/sail up -d

# Geração da Chave da Aplicação
$ ./vendor/bin/sail artisan key:generate

# Migração da Database da Aplicação
$ ./vendor/bin/sail artisan migrate 

# Seed na Database de alguns clientes para teste como solicitado
$ ./vendor/bin/sail artisan db:seed
```

O acesso da aplicação acontece em "localhost/", pois a porta da aplicação é a 80 como padrão.