## Teste Onfly
Teste criado para empresa onfly.

Este teste foi desenvolvido utilizando o docker [laradock](https://laradock.io/). Caso queira utiliza-lo favor seguir os seguintes passos.

### 1- Clone o laradock para a raiz do projeto

```
git submodule update --init --recursive
```

### 2- Copie o arquivo .env.exemple

```
cp .env.example .env
``` 

### 3- Entre na pasta do laradock e faça o mesmo com o .env.exemple dele
```
cd laradock
cp .env.example .env
```

### 4- Abra o arquivo .env procure a opção COMPOSE_PROJECT_NAME e altere o nome do projeto para que seja unico
```
COMPOSE_PROJECT_NAME=laradock-onfly
```

### 5- Ainda no .env procure a configuração PHP_VERSION e mude para a versão 8.2
```
PHP_VERSION=8.2
```
### 6- No terminal dentro da pasta laradock rode o seguinte comando
```
docker compose up -d nginx mysql phpmyadmin workspace 
```
### 7- Apos terminar de subir os containers execute o comando abaixo para acessar o container
```
docker compose exec workspace bash
```
### 8- Agora no container execute o comando para instalar as dependencias
```
composer install
```
 
### 9- Agora corrija as permissões dos arquivos de storage
```
chmod -R 777 storage/logs/
chmod -R 777 storage/framework/
```

### 10- Gere a chave de aplicação do laravel
```
php artisan key:generate
```

### 11- Realize as migrations 
```
php artisan migrate
```

### 12- Instale o vite e compile os css e js
```
npm install --save-dev @vitejs/plugin-vue
npm run build
```

### Pronto
O teste já estará rodando corretamente na url http://localhost/

## Api
Para o teste foi desenvolvida uma api de despesas. 

### Login 
POST            api/auth/login 
```
{
    "email": "teste@teste.com",
    "password": "password123"
}
```
response
```
{
    "status": true,
    "message": "User Logged In Successfully",
    "token": "8|rhbNsBMw9tUdvp2pFcXpcyPTlYosbsBpbZx6SzSk9878519e"
}
```
### Logout
POST            api/auth/logout

&nbsp;
A rota logout deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.

### Register
POST            api/auth/register
```
{
    "name": "Name",
    "email": "teste@teste.com",
    "password": "password123"
}
```
response
```
{
    "status": true,
    "message": "User Created Successfully",
    "token": "9|iAlIfRC3hXgcIZQ8knHaGGDUBvmRfu365GUyglVc3b5c2470"
}
```
### Despesas get
GET|HEAD        api/despesas-api

&nbsp;
A rota deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.

response
```
[
    {
        "id": 37,
        "created_at": "2023-11-02T11:31:23.000000Z",
        "updated_at": "2023-11-02T11:31:23.000000Z",
        "descricao": "Teste",
        "data": "1993-10-27",
        "usuario": 34,
        "valor": 300.27
    }
]
```
### Despesas post
POST            api/despesas-api

&nbsp;
A rota deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.
```
{
    "descricao": "AAAAAAAAAAAAAAaa",
    "data": "1993-10-27",
    "usuario":34,
    "valor":300.27

}```
response
```
{
    "descricao": "AAAAAAAAAAAAAAaa",
    "data": "1993-10-27",
    "usuario": 34,
    "valor": 300.27,
    "updated_at": "2023-11-02T11:22:13.000000Z",
    "created_at": "2023-11-02T11:22:13.000000Z",
    "id": 36
}```

### Despesas show
GET|HEAD        api/despesas-api/{despesas_api}

&nbsp;
A rota deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.
response
```
{
    "descricao": "AAAAAAAAAAAAAAaa",
    "data": "1993-10-27",
    "usuario": 34,
    "valor": 300.27,
    "updated_at": "2023-11-02T11:22:13.000000Z",
    "created_at": "2023-11-02T11:22:13.000000Z",
    "id": 36
}
```

### Despesas update
PUT|PATCH       api/despesas-api/{despesas_api}

&nbsp;
A rota deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.
```
{
    "descricao": "Teste",
    "data": "1993-10-27",
    "usuario":34,
    "valor":300.27

}
```
response
```
{
    "id": 36,
    "created_at": "2023-11-02T11:22:13.000000Z",
    "updated_at": "2023-11-02T11:23:46.000000Z",
    "descricao": "Teste",
    "data": "1993-10-27",
    "usuario": 34,
    "valor": 300.27
}
```

### Despesas delete
DELETE          api/despesas-api/{despesas_api}

&nbsp;
A rota deve possuir em seu header um Bearer Token contendo o token recebido no momento de login.


