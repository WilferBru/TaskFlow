# TaskFlow - Fase de Testing (rama dev)

TaskFlow es una aplicación de gestión de tareas construida con **Laravel 12** como backend y **Vue 3** como frontend.

Este proyecto fue desarrollado como una aplicación completa, aplicando buenas prácticas, separación de responsabilidades y flujos reales de una aplicación SPA moderna.  
Actualmente se encuentra en **fase de testing**, donde se están validando los flujos de autenticación, roles, gestión de tareas y filtros avanzados antes de su despliegue en producción.

Para revisar los cambios en curso y pruebas activas, se recomienda usar la rama **dev**. La rama **main** contendrá la versión estable lista para producción.


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

Selecciona la rama en la que deseas trabajar (`dev` o `main`).

```bash
git switch dev
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

3. **levantar contenedores**

dentro de la carpeta TaskFlow ejecutar:

```bash
docker compose up -d --build
```

4. **Ejecuta migraciones**

dentro de carpeta TaskFlow ejecutar:

```bash
docker compose exec api php artisan migrate --seed
```

5. **Puede acceder a al app**

Puedes acceder a la app y probar la api, por defecto crea un seeder de usuario admin
con los datos

```bash
email: prueba@prueba.com
password: prueba123
```

```bash
# frontend
http://localhost:5173/
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

- Añadir pruebas unitarias y de integración.

- Subir la imagen de produccion a Dockerhub.

- Implementar Nginx en las imagens build

- Implementar Github Actions

- Desplegar en AWS

---

👨‍💻 Autor

Wilfer Bru
Desarrollador Laravel + Vue.js
[Linkedin](https://www.linkedin.com/in/wilfer-jose-bru-torres-455b7220b)
