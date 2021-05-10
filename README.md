
## Sobre o Projeto

API desenvolvida em laravel 8, CRUD de pessoas/usuarios. Utilizado Vue.js para consumir a api e gerar o front end.

## Passos para instalação e teste

### Passos para instalação e teste

```bash
# Clone este repositório
$ git clone <https://github.com/Feldens00/laravel-api.git>

# va na raiz do projeto e faça uma copia do arquivo .env.example e o nomei como .env , edite o arquivo com as configurações do banco de dados
$ copy .env.example .env

# atualize o composer
$ composer update

# gere uma chave
$ php artisan key:generate

# gere o link para acesso dos conteudos na pasta storage
$ php storage link

# gere as tabelas no db
$ php artisan migrate

# inicei o servidor do projeto (ele apontara a url de acesso local)
$ php artisan serve

# em outra janela do CMD Instale as dependências
$ npm install

# Execute a aplicação em modo de desenvolvimento
$ npm run dev
