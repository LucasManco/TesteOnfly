##Teste Onfly
Teste criado para empresa onfly.

Este teste foi desenvolvido utilizando o docker [laradock](https://laradock.io/). Caso queira utiliza-lo favor seguir os seguintes passos.

#1- Clone o laradock para a raiz do projeto

```
git submodule update --init --recursive
```

#2- Copie o arquivo .env.exemple

```
cp .env.example .env
```

#3- Entre na pasta do laradock e faça o mesmo com o .env.exemple dele
```
cd laradock
cp .env.example .env
```

#4- Abra o arquivo .env procure a opção COMPOSE_PROJECT_NAME e altere o nome do projeto para que seja unico
```
COMPOSE_PROJECT_NAME=laradock-onfly
```

#5- Ainda no .env procure a configuração PHP_VERSION e mude para a versão 8.2
```
PHP_VERSION=8.2
```
#6- No terminal dentro da pasta laradock rode o seguinte comando
```
docker compose up -d nginx mysql phpmyadmin workspace 
```
#7- Apos terminar de subir os containers execute o comando abaixo para acessar o container
```
docker compose exec workspace bash
```
#8- Agora no container execute o comando para instalar as dependencias
```
composer install
```

#9- Agora corrija as permissões dos arquivos de storage
```
chmod -R 777 storage/logs/
chmod -R 777 storage/framework/
```

#10- Gere a chave de aplicação do laravel
```
php artisan key:generate
```

#11- Realize as migrations 
```
php artisan migrate
```

#12- Instale o vite e compile os css e js
```
npm install --save-dev @vitejs/plugin-vue
npm run build
```



