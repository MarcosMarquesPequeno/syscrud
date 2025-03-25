

# Projeto Laravel + Vue.js

Este projeto é composto por uma aplicação back-end em Laravel e front-end em Vue.js. A seguir, você encontrará instruções para rodar e configurar tanto o back-end quanto o front-end.

## Tecnologias Utilizadas

### Back-end
- **Laravel 12**: Framework PHP para o desenvolvimento de APIs.
- **Sanctum**: Para autenticação de APIs.
- **PostgreSQL**: Banco de dados utilizado na aplicação.
  
### Front-end
- **Vue.js**: Framework JavaScript utilizado para criar a interface do usuário.
- **Vuetify**: Biblioteca de componentes UI para Vue.js.

## Requisitos

- PHP >= 8.2
- Composer
- Node.js e NPM
- PostgreSQL
- Laravel Sail (opcional)

## Rodando o Back-end

1. Clone o repositório do projeto:
   ```bash
   git clone <URL_DO_REPOSITORIO>
   cd <PASTA_DO_PROJETO>
   ```

2. Instale as dependências do Laravel:
   ```bash
   composer install
   ```

3. Crie o arquivo `.env` a partir do exemplo:
   ```bash
   cp .env.example .env
   ```

4. Configure seu banco de dados PostgreSQL no arquivo `.env`:
   ```dotenv
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=postgress
   DB_USERNAME=postgress
   DB_PASSWORD=postgress
   ```

5. Gere a chave da aplicação Laravel:
   ```bash
   php artisan key:generate
   ```

6. Rode as migrações do banco de dados:
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor Laravel:
   ```bash
   php artisan serve
   ```
   O back-end estará disponível em `http://127.0.0.1:8000`.

## Endpoints da API

Aqui estão os principais endpoints da API que você pode utilizar:

- **POST** `api/login`: Faz login de um usuário.
- **POST** `api/logout`: Realiza logout de um usuário.
- **POST** `api/register`: Cadastra um novo usuário.
- **GET** `api/users`: Retorna todos os usuários.
- **POST** `api/users`: Cria um novo usuário.
- **GET** `api/users/{user}`: Exibe um usuário específico.
- **PUT/PATCH** `api/users/{user}`: Atualiza um usuário.
- **DELETE** `api/users/{user}`: Deleta um usuário.

## Rodando o Front-end

1. Instale as dependências do Vue.js:
   ```bash
   npm install
   ```

2. Inicie o servidor de desenvolvimento:
   ```bash
   npm run dev
   ```

   O front-end estará disponível em `http://localhost:3000`.

## Contribuição

Se você quiser contribuir com o projeto, por favor, siga as etapas abaixo:

1. Faça um fork do repositório.
2. Crie uma nova branch (`git checkout -b feature/nova-funcionalidade`).
3. Faça as modificações desejadas.
4. Commit suas alterações (`git commit -am 'Adicionando nova funcionalidade'`).
5. Faça o push para a sua branch (`git push origin feature/nova-funcionalidade`).
6. Abra um pull request.

## Licença

Este projeto é licenciado sob a licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.
>>>>>>> 10190b2 (system 25.3.25)
