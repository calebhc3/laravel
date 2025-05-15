🚀 Desafio Técnico Laravel - Calebh
Um projeto Laravel 11 com arquitetura API-first, contendo sistema de autenticação, gerenciamento de usuários e integração com ViaCEP.

📋 Pré-requisitos
Docker e Docker Compose instalados

Git para clonar o repositório

🛠️ Configuração do Ambiente
bash
# Clone o repositório
git clone https://github.com/calebhc3/laravel.git
cd laravel

# Crie o arquivo do banco de dados SQLite (se necessário)
touch database/database.sqlite

# Inicie os containers (Laravel + MailHog + SQLite)
docker-compose up -d --build

🌐 Acessos
Aplicação: http://localhost:8000

MailHog (Interface de e-mails): http://localhost:8025

🔐 Rotas da API
Autenticação
Login
POST /api/login

json
{
  "email": "admin@admin.com",
  "password": "12345678"
}

Cadastro de usuário
POST /api/register

json
{
  "name": "João da Silva",
  "email": "joao@example.com",
  "password": "12345678",
  "password_confirmation": "12345678",
  "cep": "01001000",
  "numero": "100"
}

Recuperação de senha
POST /api/forgot-password

json
{
  "email": "joao@example.com"
}

POST /api/reset-password

json
{
  "email": "joao@example.com",
  "token": "token-recebido-por-email",
  "password": "novaSenha123",
  "password_confirmation": "novaSenha123"
}

🔒 Rotas Protegidas (requer token de autenticação)
Usuário autenticado
GET /api/me - Retorna dados do usuário logado

Listagem de usuários
GET /api/users - Lista usuários com paginação

👨‍💻 Painel Administrativo (apenas para role: admin)
GET /api/admin/dashboard - Métricas do sistema (total de usuários, por cidade)

GET /api/admin/users - Listar todos os usuários

PUT /api/admin/users/{id} - Atualizar usuário

DELETE /api/admin/users/{id} - Excluir usuário

🧪 Testes
Para executar os testes automatizados:

docker-compose exec app php artisan test


🏗️ Arquitetura e Decisões Técnicas
Laravel 12 com abordagem API-first

Autenticação via Laravel Sanctum para tokens de API

Service Layer para integração com ViaCEP

Eventos/Listeners para envio assíncrono de e-mails

MailHog para simulação de envio de e-mails em desenvolvimento

Middleware customizado para controle de acesso baseado em roles

SQLite para banco de dados 

Docker para ambiente isolado e replicável