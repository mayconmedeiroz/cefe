# Centro Esportivo da FAETEC

Projeto que visa melhorar o funcionamento do CEFE.

## Como Começar

Essas instruções farão com que você tenha uma cópia do projeto em execução na sua máquina local para fins de desenvolvimento e teste.

### Pré-requisitos

* PHP >= 7.1.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

### Instalação

* Clone o repositório
```sh
git clone https://github.com/mayconmedeiroz/cefe
```
* Execute `composer install` para ambiente de `desenvolvedor` ou `composer install --optimize-autoloader --no-dev` para ambiente de   `produção` e instale os pacotes do Laravel

* Gere `APP_KEY` usando `php artisan key:generate`

* Edite a configuração de conexão do banco de dados no arquivo .env, por exemplo.
```sh
DB_HOST=db
DB_PORT=3306
DB_DATABASE=projeto-cefe
DB_USERNAME=root
DB_PASSWORD=senhadousuario
```

* Migre seu banco de dados com `php artisan migrate`

* Semeie seu banco de dados com `php artisan db:seed`

* Inicie com `php artisan serve`


## License

Este projeto está licenciado sob a licença MIT - consulte o arquivo [LICENSE](LICENSE.md) para obter detalhes
