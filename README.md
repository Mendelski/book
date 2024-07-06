<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Como rodar

Após clonar o projeto:

copie o arquivo .env.example e renomeie para .env

Verifique no env a configuração de banco de dados, e garanta que o projeto está apontando para seu banco de dados, por padrão está configurado para rodar em um banco postgres com o usuário postgres e senha root, no database book.

Com o banco conectado, siga os passos:

1. Rode o comando `composer install`
2. Rode o comando `npm install`
3. Rode o comando `php artisan migrate`
4. Rode o comando `php artisan db:seed`
5. Rode o comando `php artisan passport:keys`
6. Rode o comando `php artisan passport:client` quando for solicitado, informe o id do usuário que deseja criar o token, e o nome do cliente, por padrão id 1.
7. Rode o comando `php artisan serve`

## Rotas

Na pasta postman, na raiz do projeto temos uma collection com as rotas do projeto, importe no postman e utilize para testar as rotas.


