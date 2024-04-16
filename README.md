# UserManager
Esta API foi desenvolvida como método de estudo da linguagem PHP, ela permite aos usuários se cadastrar, editar e excluir sua conta. Além disso, ela possui um sistema de autenticação para garantir a segurança de rotas sensíveis.

## Recursos Disponíveis

A API oferece os seguintes recursos:

- **Autenticação**: Os usuários podem se autenticar para acessar os recursos protegidos da API.
- **Criação de conta**: Os usuários podem se cadastrar no sistema.
- **Edição de conta**: Os usuários podem editar seu nome de perfil.
- **Exclusão de conta**: Os usuários podem excluir sua própria conta do sistema.

## Tecnologias utilizadas
### Banco de Dados
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)

### Backend
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

## Endpoints da API

### Autenticação

- `POST /api/users/login`: Endpoint para autenticar um usuário e obter um token de acesso.

### Usuário

- `POST /api/users/create`: Endpoint para criar/ cadastrar um usuário.
- `GET /api/users/fetch`: Endpoint para obter detalhes do usuário logado.
- `PUT /api/users/update`: Endpoint para editar o nome do usuário logado.
- `DELETE /api/users/delete`: Endpoint para excluir o usuário logado.

## Como utilizar

- **Autenticação**: Envie uma solicitação POST para /api/login com as credenciais de usuário para obter um token JWT.
- **CRUD de Usuário**: Autenticação JWT é necessária para utilizar as rotas /api/users para realizar operações CRUD de usuários.

```sh

# Clone o repositório
$ git clone https://github.com/anielmelo/UserManager.git

# Coloque o projeto no diretório
/var/www/html

# Instale as dependências do PHP
$ composer update

```
