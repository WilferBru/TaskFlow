# TaskFlow — Full Stack Task Management App (Laravel + Vue 3)

TaskFlow es una aplicación full stack de gestión de tareas diseñada con enfoque en **arquitectura limpia**, **seguridad**, **testing de flujos críticos** y **despliegue profesional con Docker**.

> ✅ **Estado del proyecto**
>
> La rama **`main`** contiene la versión **estable y lista para producción**.
> Puede ejecutarse directamente utilizando imágenes oficiales publicadas en DockerHub.

---

## 🚀 Características principales

- Autenticación segura con **Laravel Sanctum**
  - Registro
  - Inicio y cierre de sesión
  - Cambio de contraseña
- Gestión completa de tareas (CRUD)
- Filtros avanzados por:
  - Categoría
  - Estado
  - Prioridad
  - Palabra clave
- Sistema de roles y permisos (**Admin / User**)
- Autorización mediante **Policies**
- Backend con separación clara de responsabilidades:
  - Controllers delgados
  - Lógica de negocio en Actions
  - Validación con Form Requests
  - Respuestas con API Resources
- Frontend moderno con:
  - Rutas protegidas
  - Estado global con Pinia
  - Servicios HTTP desacoplados

---

## 🧪 Testing

El proyecto incluye pruebas enfocadas en **flujos críticos**, siguiendo un enfoque realista orientado a estabilidad.

### Backend

- Feature tests de autenticación:
  - Login
  - Logout
  - Rutas protegidas con Sanctum

### Frontend

- Test del flujo de inicio de sesión
- Test del guard global de rutas protegidas

> El objetivo del testing es garantizar la estabilidad de los flujos esenciales, no la cobertura total.

---

## 🛠️ Tecnologías

### Backend

- Laravel 12
- PHP 8.3
- API REST
- Sanctum
- Policies, Actions, Form Requests, API Resources

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

## 🧠 Arquitectura

TaskFlow aplica principios de **separación de responsabilidades** y **arquitectura limpia**:

### Backend

- Controllers delgados
- Lógica de negocio aislada en Actions
- Autorización centralizada con Policies
- Validación consistente con Form Requests
- Respuestas normalizadas con API Resources

### Frontend

- Arquitectura modular
- Separación de vistas, stores y servicios
- Guards de rutas para control de acceso
- Manejo de estado global con Pinia

---

## 🌿 Estrategia de ramas

Este repositorio utiliza una separación clara de responsabilidades por ramas:

- **`main`**  
  Versión estable y lista para producción.  
  Consume imágenes oficiales desde DockerHub.

- **`deploy`**  
  Contiene CI/CD, Dockerfiles y workflows de GitHub Actions.  
  Responsable de construir y publicar imágenes.

- **`dev`**  
  Rama de desarrollo activo.  
  Incluye configuración local, tooling y documentación técnica detallada.

---

## 🚀 Despliegue en producción

### Requisitos

- Docker
- Docker Compose

### Ejecución

1. Clonar el repositorio y entrar al proyecto:

```bash
git clone https://github.com/WilferBru/TaskFlow.git
cd TaskFlow
git switch main
```

### Crear el archivo de entorno:

```bash
cp .env.example .env
```

### Levantar aplicacion

```bash
docker compose -f docker-compose.prod.yml up -d

```

### Ejecutar migraciones y seeder (producción):

```bash
docker compose -f docker-compose.prod.yml exec api php artisan migrate --seed --force

```

### Inicialización de la base de datos

La primera ejecución incluye seeders de inicialización que crean
los roles base y un usuario administrador inicial necesario
para la administración del sistema.

Este paso debe ejecutarse una sola vez al desplegar la aplicación.

---

## 📚 Documentación adicional:

La documentación técnica detallada se encuentra en las ramas correspondientes:

### Back-end

[backend/laravel-api/README.md](https://github.com/WilferBru/TaskFlow/blob/dev/backend/laravel-api/README.md)

### Front-end

[frontend/vue-SPA/README.md](https://github.com/WilferBru/TaskFlow/blob/dev/frontend/vue-SPA/README.md)

---

## 📦 Docker Images

The application is distributed using official Docker images:

- Backend: https://hub.docker.com/r/wilferbru/taskflow-backend
- Frontend: https://hub.docker.com/r/wilferbru/taskflow-frontend

Images are built and published automatically via CI/CD pipelines.

---

👨‍💻 Autor

Wilfer Bru
Desarrollador Laravel + Vue.js
[Linkedin](https://www.linkedin.com/in/wilfer-jose-bru-torres-455b7220b)
