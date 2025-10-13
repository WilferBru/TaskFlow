# TaskFlow Desarrollo (rama dev)

TaskFlow es una aplicación de gestión de tareas construida con **Laravel 12** como backend y **Vue.js** como frontend.  
La idea principal de este proyecto es poner a prueba los conocimientos; la idea final es desarrollarla, documentarla y subirla a la nube.

---

## Características actuales

- Autenticación de usuarios con **Sanctum**
- Lógica de los controladores para las acciones de los usuarios (registrarse, login, crear tareas, ver, filtrar, etc.)
- Filtrar tareas por:
  - Categorías
  - Estado
  - Palabra clave en título o descripción
- Manejo de herramientas de Laravel como **Request**, **Resource**, **Scope** y rutas **API**

---

## Tecnologías

- **Backend:** Laravel 12, PHP 8.2 (detalles en `~/TaskFlow/backend/laravel-api/Dockerfile`)
- **Frontend:** Vue.js (detalles en `~/TaskFlow/frontend/vue-SPA/Dockerfile`)
- **Base de datos:** PostgreSQL (detalle de conexión en `docker-compose.yml`)
- **Autenticación:** Laravel Sanctum
- **Host:** Docker Compose

---

## Instalación

1. **Clonar el repositorio:**

```bash
git clone https://github.com/WilferBru/TaskFlow.git
cd TaskFlow
```

2. **Editar .env**

Crea tu archivo .env basado en .env.example y configura la conexión a la base de datos (~/TaskFlow/backend/laravel-api/.env).

3. **levantar contenedores**

dentro de la carpeta TaskFlow ejecutar:

docker compose up -d --build

4. **Ejecuta migraciones**

dentro de carpeta TaskFlow ejecutar:

docker compose exec api php artisan migrate --seed

5. **Puede acceder a al app**

Puedes acceder a la app y probar la api, por defecto crea un seeder de usuario admin
con los datos

'email' => 'prueba@prueba.com',
'password' => 'prueba123'

Pero tambien puede loguearse como usuario en register

---

## Próximos pasos

- Implementar Roles y permisos para usuarios.

- Mejorar la interfaz de Vue.js para mostrar tareas y filtros.

- Añadir pruebas unitarias y de integración.

- Subir la imagen de produccion a Dockerhub

- Implementar Github Actions

- Desplegar en AWS
