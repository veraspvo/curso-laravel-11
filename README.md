
# Setup Docker Laravel 11 com PHP 8.3
[Curso Celke](https://academy.especializati.com.br)

### Passo a passo
Clone Repositório - curso-celke Laravel 11
```sh
git clone -b xxxxx https://github.com/xxxxxxxxxx.git curso-laravel-celke
```
```sh
cd curso-laravel-celke
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Crie o Arquivo .env
```sh
cp .env.example .env
```

Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

OPCIONAL: Gere o banco SQLite (caso não use o banco MySQL)
```sh
touch database/database.sqlite
```

Rodar as migrations
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
