# VN Welcome

## Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Environment

| PHP | NodeJS | Mysql | Nginx  |
| :-: | :----: | :---: | :----: |
| 8.2 |  18.x  |  8.0  | 1.23.4 |

## Installation

### Install project with docker

```bash
cp .env.example .env
docker-compose build
docker-compose up -d
```

### Access to the container

```bash
docker exec -it workspace_vn_welcome bash
```

### Run command inside visited container

```bash
cp .env.example .env
composer install
php artisan key:gen
npm install
npm run prod
```

## Access

- Web `http://localhost:${APP_PORT}`
- PhpMyadmin `http://localhost:${MY_ADMIN_PORT}`
