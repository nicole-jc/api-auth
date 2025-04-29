# 🔐 Laravel API - Autenticação e Gerenciamento de Usuários

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=flat&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7-orange?logo=mysql)](https://www.mysql.com/)
[![Postman](https://img.shields.io/badge/Tested_with-Postman-FF6C37?logo=postman)](https://www.postman.com/)
[![License](https://img.shields.io/badge/license-MIT-lightgrey)](LICENSE)

---

API RESTful construída com Laravel + Sanctum para registro, login, autenticação, verificação de e-mail, reset de senha e CRUD de usuários.

## ⚙️ Ferramentas usadas

  * PHP >= 8.2.12

  * Composer

  * Laravel >= 12

  * Banco de dados (MySQL)

  * Mailtrap para testes de e-mail

  * Postman
    
## Como rodar o projeto
1. Instale as dependencias:
```bash
composer install
```
2. Configure o banco de dados no arquivo .env
   
3. Configure o Mailtrap no arquivo .env 
   
4. Gere a chave do app Laravel:
```bash
php artisan key:generate
```
5. Execute as migrations:
```
php artisan migrate
```
6. Inicie o servidor:
```bash
php artisan serve
```

## Testes com Postman
Headers obrigatórios:

    Key: Accept

    Value: application/json

Recomenda-se instalar o Postman Agent para chamadas localhost.

## Rotas 
**👥 Listar Usuários**

**🔸 Listar todos os usuários**

  * URL: /api/users

     * Method: GET

**🔸 Listar um usuário específico**

  * URL: /api/users/{id}

    * Method: GET
#
**🔐 Autenticação**

**▶️ Register**

  * URL: /api/register

    * Method: POST

  **Body (JSON):**
```
{
  "name": "Example",
  "email": "example@example.com",
  "password": "Pass@12345",
  "password_confirmation": "Pass@12345"
}
```
#
**🔓 Login**

  * URL: /api/login

    * Method: POST

  **Body (JSON):**
```
{
  "email": "example@example.com",
  "password": "Pass@12345"
}
```
#
**🔒 Logout**

  * URL: /api/logout

    * Method: POST

    * Authorization: Bearer Token

  ## 📫 Verificação de E-mail
🔹 **1. Enviar link de verificação**

  * URL: /api/email/verify/notification

    * Method: POST

    * Authorization: Bearer Token
#
🔹 **2. Verificar e-mail com o link**
  * Copie o link enviado via e-mail (Mailtrap)

     * Method: GET

     * Authorization: Bearer Token

    *Exemplo de URL:*
```
http://127.0.0.1:8000/email/verify/{id}/{hash}?expires=...&signature=...
```
## 🔑 Recuperação de Senha
🔹 **1. Enviar link de redefinição**

  * URL: /api/password/forgot

    * Method: POST

  **Body** (JSON):
```
{
  "email": "example@example.com"
}
```
#
🔹 **2. Redefinir senha (com token do e-mail)**

  *Exemplo de URL recebida:*
   ```
   http://localhost:8000/api/password/reset/{token}?email=example@example.com
   ```
  * URL: /api/password/reset

    * Method: POST

  **Body (JSON):**
```
{
  "token": "{token_do_link}",
  "email": "example@example.com",
  "password": "Pass12345",
  "password_confirmation": "Pass12345"
}
```
