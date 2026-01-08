# TaskFlow — Full Stack Task Management App (Laravel + Vue 3)

Proyecto full stack con autenticación, roles, políticas de autorización, testing crítico y arquitectura limpia.

> ✅ **Estado del proyecto**
>
> La rama **`main`** contiene la versión **estable y lista para producción** de la aplicación.
> Puede ser desplegada directamente en un servidor utilizando Docker.

---

## 🚀 Características actuales

- Autenticación de usuarios con **Laravel Sanctum**
  - Registro
  - Inicio y cierre de sesión
  - Cambio de contraseña
- Gestión de tareas (CRUD)
- Filtros avanzados de tareas por:
  - Categoría
  - Estado
  - Prioridad
  - Palabra clave en título o descripción
- Sistema de roles y permisos (**Admin / User**)
- Autorización mediante **Policies**
- Separación de la lógica de negocio utilizando **Actions**
- Uso de herramientas nativas de Laravel:
  - Form Requests
  - API Resources
  - Scopes
  - Rutas API
- Policies implementadas para:
  - Usuarios
  - Tareas
  - Estados de tarea
  - Categorías

---

## 🧪 Testing

El proyecto incluye pruebas enfocadas en **flujos críticos**, siguiendo un enfoque realista y profesional.

### Backend (Laravel)

- Feature tests para autenticación:
  - Login
  - Logout
  - Rutas protegidas con Sanctum

### Frontend (Vue 3)

- Test del flujo de inicio de sesión
- Test del guard global de rutas (autenticación / rutas protegidas)

> El objetivo del testing no es cubrir el 100%, sino asegurar la estabilidad de los flujos esenciales de la aplicación.

---

## 🛠️ Tecnologías

### Backend

- **Laravel 12**
- **PHP 8.2**
- API REST
- Laravel Sanctum (autenticación)
- Policies, Form Requests y Resources

### Frontend

- **Vue 3**
- **TypeScript**
- **Vite**
- **Pinia**
- **Vue Router**
- **Axios**
- TailwindCSS + DaisyUI

### Base de datos

- **PostgreSQL**

### Infraestructura

- **Docker**
- **Docker Compose**

---

## 🧠 Arquitectura

TaskFlow aplica principios de **separación de responsabilidades**, especialmente en el backend:

- Controllers delgados
- Lógica de negocio en Actions
- Autorización con Policies
- Validación con Form Requests
- Respuestas consistentes con API Resources

El frontend sigue una estructura modular basada en:

- Vistas
- Stores (Pinia)
- Servicios HTTP
- Rutas protegidas

---

## Instalación

1. **Clonar el repositorio:**

```bash
git clone https://github.com/WilferBru/TaskFlow.git
cd TaskFlow
```

Al clonar el repositorio, es importante seleccionar la rama adecuada. La rama main contiene la versión estable y lista para producción, mientras que la rama dev es para desarrollo y pruebas.

```bash
git branch -r
```

Selecciona la rama en la que deseas trabajar (`dev`, `main` o `deploy`).

```bash
git switch main
```

2. **Configuracion de archivos .env**

Crea los archivos .env necesarios para la conexión entre el frontend, el backend y la base de datos.

#### Archivo principal del proyecto

Crea un archivo .env en la raíz del proyecto basándote en el archivo de ejemplo:

```bash
cp .env.example .env
```

#### Archivo del backend (Laravel API)

Crea un archivo .env en el backend para configurar la conexión con la base de datos:

```bash
cp .env.example .env
```

#### Archivo del frontend (Vue SPA)

Crea un archivo .env en el frontend para definir la URL base desde donde se consumirá la API y realizar las peticiones HTTP:

```bash
cp .env.example .env
```

> ⚠️ **Importante**
> En producción Docker, el frontend debe apuntar directamente al backend.
>
> Ejemplo:
>
> ```env
> VITE_API_URL=http://localhost:8000/api
> ```

3. **Levantar contenedores**

dentro de la carpeta TaskFlow ejecutar:

```bash
docker compose -f docker-compose.prod.yml up -d --build
```

4. **Ejecuta migraciones (Produccion)**

dentro de carpeta TaskFlow ejecutar:

```bash
docker compose -f docker-compose.prod.yml exec api php artisan migrate --seed --force
```

5. **Puedes acceder a al app**

Puedes acceder a la app y probar la api, por defecto crea un seeder de usuario admin
con los datos

```bash
email: prueba@prueba.com
password: prueba123
```

```bash
# frontend
http://localhost:4173/
```

```bash
# backend
http://localhost:8000/api/
```

Pero tambien puede registrarse como usuario en register

---

## Documentación de la API (Backend)

Toda la información sobre los endpoints, autenticación y roles de usuario se encuentra en el archivo:

[backend/laravel-api/README.md](https://github.com/WilferBru/TaskFlow/blob/dev/backend/laravel-api/README.md)

Ahí encontrarás:

- Cómo registrar y autenticar usuarios
- Qué rutas están disponibles
- Qué permisos tiene cada rol (admin y user)
- Ejemplos de peticiones y respuestas JSON

---

## Documentación del Frontend

Para conocer cómo configurar y ejecutar la parte del frontend, visita:

[frontend/vue-SPA/README.md](https://github.com/WilferBru/TaskFlow/blob/dev/frontend/vue-SPA/README.md)

---

## Próximos pasos

- Publicar imágenes de producción en DockerHub.
- Implementar CI/CD con GitHub Actions para build y push automáticos.
- Desplegar en un VPS con dominio y HTTPS (Let’s Encrypt).

---

👨‍💻 Autor

Wilfer Bru
Desarrollador Laravel + Vue.js
[Linkedin](https://www.linkedin.com/in/wilfer-jose-bru-torres-455b7220b)
