# API-BAND
### Api criada para fins de estudo e prática

### Descrição
api voltada para organização de grupos musicais, com possibilidade de cada músico/cantor, participar de vários grupos, e em cada grupo, ter suas agendas ou escalas, com repertório.

### Contexto de negócio
```
Docker
Nginx
MySql
Laravel
PHP 8.1
JWT token
Migrations
```


## Executar localmente
na primeira vez, use:
```
# docker-compose up -d --build
```

nas seguintes, use:
```
# docker-compose up -d (para subir o container)
# docker-compose stop (para parar o container)
```

gere a chave dr criptografia
```
# docker exec setup-php php artisan key:generate
```

rode as migrations para criar as tabelas.
```
# docker exec setup-php php artisan migrate
- Necessário existir arquivo '.env' na raiz do projeto (copy .env.example .env)
```

rode as db:seed para criar o usuário admin.
```
# docker exec setup-php php artisan db:seed
- user: admin@gmail.com
- password: 123456
```

se faltar alguma dependência use o compose install dentro do container
```
# docker exec setup-php composer install
```

## Autenticação
```
Bearer Token: 
```


##  Rotas não autenticadas
```
POST: http://localhost:8080/api/v1/login
POST: http://localhost:8080/api/v1/user
```

### Possíveis erros
se der erro de permissão, rodar o seguinte comando.
```
docker exec -it --user=root setup-php chmod -R 777 /var/www/storage
```


#### endereços para acesso:
```
PhpMyAdmin: http://localhost:8888/
Endereço da api: http://localhost:8080/api/v1/
```

Developed by Neilton Rodrigues