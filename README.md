# Laravel Nuxt Chat Application

A chat application with support for text messages and file attachments, built on Laravel 11 and Nuxt 3.


## Use Commands

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve


## You're ready to go! Visit the url in your browser, and login with:
Username: admin@filamentphp.com
Password: Test7894*


# Project Setup Instructions

## Technologies

### Backend (Laravel 11)
- PHP 8.2
- Laravel 11
- PostgreSQL 14
- Redis for caching
- Laravel Sanctum for API authentication

### Frontend (Nuxt 3)
- Nuxt 3
- TypeScript 
- Tailwind CSS
- Nuxt UI
- DaisyUI

## Installation and Launch via Docker

### Prerequisites
- Docker and Docker Compose
- Git

### Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/ShandSt/laravel_nuxt_chat.git
cd laravel_nuxt_chat
```

2. Start Docker containers:
```bash
docker-compose up -d
```

3. Install PHP dependencies:
```bash
docker exec -it chat_app composer install
```

4. Copy and configure the environment file:
```bash
cp .env.example .env
```

5. Generate the application key:
```bash
docker exec -it chat_app php artisan key:generate
```

6. Run database migrations:
```bash
docker exec -it chat_app php artisan migrate
```

7. Create a symbolic link for storage:
```bash
docker exec -it chat_app php artisan storage:link
```

8. Install JavaScript dependencies:
```bash
docker exec -it chat_frontend npm install
```

9. Start Nuxt.js in development mode:
```bash
docker exec -it chat_frontend npm run dev
```

### Accessing the Application

- Backend API: http://localhost:8000
- Frontend: http://localhost:3000

## Manual Installation (without Docker)

### Backend (Laravel)

1. Install PHP dependencies:
```bash
composer install
```

2. Copy and configure the environment file:
```bash
cp .env.example .env
```

3. Configure PostgreSQL database connection in the .env file

4. Generate the application key:
```bash
php artisan key:generate
```

5. Run database migrations:
```bash
php artisan migrate
```

6. Create a symbolic link for storage:
```bash
php artisan storage:link
```

7. Start the Laravel development server:
```bash
php artisan serve
```

### Frontend (Nuxt.js)

1. Navigate to the frontend directory:
```bash
cd frontend
```

2. Install JavaScript dependencies:
```bash
npm install
```

3. Start Nuxt.js in development mode:
```bash
npm run dev
```

## Development Commands

### Laravel (PHP) Commands

Execute inside the `chat_app` container:

```bash
# Clear configuration cache
docker exec -it chat_app php artisan config:clear

# Clear route cache
docker exec -it chat_app php artisan route:clear

# Clear all caches
docker exec -it chat_app php artisan optimize:clear

# Run tests
docker exec -it chat_app php artisan test

# Create a new controller
docker exec -it chat_app php artisan make:controller NomeControllerController

# Create a new migration
docker exec -it chat_app php artisan make:migration create_nome_table
```

### Nuxt.js (Frontend) Commands

Execute inside the `chat_frontend` container:

```bash
# Start in development mode
docker exec -it chat_frontend npm run dev

# Build for production
docker exec -it chat_frontend npm run build

# Start after build
docker exec -it chat_frontend npm run start

# Lint code
docker exec -it chat_frontend npm run lint

# Fix linting errors
docker exec -it chat_frontend npm run lint:fix
```

## Restarting Services

```bash
# Restart all services
docker-compose restart

# Restart only Laravel (backend)
docker-compose restart app
docker-compose restart nginx

# Restart only Nuxt.js (frontend)
docker-compose restart frontend
```

## API Structure

### Authentication
- `POST /api/register` - Register a new user
- `POST /api/login` - Log in
- `POST /api/logout` - Log out
- `GET /api/me` - Get authenticated user data

### Chats
- `GET /api/chats` - Get all user chats
- `POST /api/chats` - Create a new chat
- `GET /api/chats/{chat}` - Get a specific chat
- `POST /api/chats/{chat}/users` - Add users to a chat
- `DELETE /api/chats/{chat}/users` - Remove users from a chat
- `DELETE /api/chats/{chat}/leave` - Leave a chat

### Messages
- `GET /api/chats/{chat}/messages` - Get all chat messages
- `POST /api/messages` - Send a new message
- `GET /api/messages/{message}` - Get a specific message
- `POST /api/messages/{message}/read` - Mark a message as read
- `POST /api/chats/{chat}/read` - Mark all messages in a chat as read
- `DELETE /api/messages/{message}` - Delete a message

### Attachments
- `POST /api/attachments` - Upload a new attachment
- `GET /api/attachments/{attachment}` - Get a specific attachment
- `DELETE /api/attachments/{attachment}` - Delete an attachment

## Troubleshooting

### Database Issues
If you encounter database issues, try rerunning migrations:
```bash
docker exec -it chat_app php artisan migrate:fresh
```

### Laravel Cache Issues
If you encounter Laravel cache issues, clear all caches:
```bash
docker exec -it chat_app php artisan optimize:clear
```

### Frontend Issues
If you encounter frontend issues, restart the container and clear npm cache:
```bash
docker-compose restart frontend
docker exec -it chat_frontend npm cache clean --force
docker exec -it chat_frontend npm install
```
