# API-BAND
### Api criada para fins de estudo e prática

### Descrição
api voltada para organização de grupos musicais, com possibilidade de cada músico/cantor, participar de vários grupos, e em cada grupo, ter suas agendas ou escalas, com repertório.

### Contexto de negócio
```
Utiliza B-Wing, First Class, Product Hub, Correios API, Killmonger e Twilio
Envia para IguanaFix, Checkout Service e Vinculo-vendedor-cliente
```

Developed by Neilton Rodrigues


- Necessário existir arquivo '.env' na raiz do projeto


## Executar localmente
```
# docker-compose up -d --build
# docker exec setup-php php artisan migrate
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
Endereço da api: http://localhost:8080/api/
```
