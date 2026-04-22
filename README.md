# TaskFlow — Full Stack Task Management App (Laravel + Vue 3)

TaskFlow es una aplicación full stack de gestión de tareas construida con Laravel y Vue 3, enfocada en arquitectura limpia, seguridad y despliegue con Docker.

---

## 🚀 Estado del proyecto

La rama **`main`** contiene una versión estable, reproducible y lista para ejecutar localmente.

---

## 🛠️ Tecnologías

### Backend

- Laravel 12
- PHP 8.3
- API REST
- Laravel Sanctum

### Frontend

- Vue 3
- TypeScript
- Vite
- Pinia
- Vue Router
- Axios
- TailwindCSS + DaisyUI

### Base de datos

- PostgreSQL

### Infraestructura

- Docker
- Docker Compose

---

## 🚀 Ejecución del proyecto

### Requisitos

- Docker
- Docker Compose

---

### 1. Clonar repositorio

```bash
git clone https://github.com/WilferBru/TaskFlow.git
cd TaskFlow
```

---

### 2. Configurar variables de entorno

#### Backend

```bash
cp backend/laravel-api/.env.example backend/laravel-api/.env
```

---

#### Variables de entorno (Docker)

```bash
cp .env.example .env
```

---

#### Frontend

👉 No requiere configuración adicional.
El archivo `.env.production` ya está configurado correctamente.

---

### ⚠️ Nota importante sobre la base de datos

El archivo `.env` de la raíz (usado por Docker) y el `.env` del backend deben tener **las mismas credenciales de base de datos**.

Ejemplo:

# .env (raíz)

DB_DATABASE=task
DB_USERNAME=postgres
DB_PASSWORD=secret

# backend/laravel-api/.env

DB_DATABASE=task
DB_USERNAME=postgres
DB_PASSWORD=secret

👉 Si estos valores no coinciden, el backend no podrá conectarse a la base de datos.

---

### 3. Levantar aplicación

```bash
docker compose up -d --build
```

---

### 4. Ejecutar migraciones y seeders

```bash
docker exec -it taskflow-api php artisan migrate --seed --force
```

---

## 🌐 Acceso

- Frontend → http://localhost:4173
- Backend → http://localhost:8000

---

## 🧠 Arquitectura

### Backend

- Controllers delgados
- Lógica de negocio en Actions
- Policies para autorización
- Form Requests para validación
- API Resources para respuestas

### Frontend

- Arquitectura modular
- Stores con Pinia
- Rutas protegidas
- Servicios HTTP desacoplados

---

## 🌿 Ramas

- **main** → versión estable
- **deploy** → CI/CD y Docker
- **dev** → desarrollo

---

## 👨‍💻 Autor

Wilfer Bru
Desarrollador Laravel + Vue.js
https://www.linkedin.com/in/wilfer-jose-bru-torres-455b7220b
