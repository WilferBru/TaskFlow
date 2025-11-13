# TaskFlow en Desarrollo (rama dev)

TaskFlow es una aplicación de gestión de tareas construida con **Laravel 12** como backend y **Vue.js** como frontend.  
La idea principal de este proyecto es poner a prueba los conocimientos; la idea final es desarrollarla, documentarla y subirla a la nube. De momento esta en fase de desarrollo por lo que se recomienda usar la rama dev.

---

## Características actuales

- Autenticación de usuarios con **Sanctum**
- Lógica de los controladores para las acciones de los usuarios (registrarse, login, crear tareas, ver, filtrar, etc.)
- Filtrar tareas por:
  - Categorías
  - Estado
  - Palabra clave en título o descripción
- Manejo de herramientas de Laravel como **Request**, **Resource**, **Scope** y rutas **API**
- Implementacion de policy para permisos y manejos de rol y acciones para separar la logica solo
  para el controaldor user
- Impĺemnataciond e accion para el controlador Task, para separar logica
- Implementar policy para los controladores Task, StateTask y Category

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

Tenga en cuenta que al clonar el repositorio debe listar las ramas de este mismo y seleccionar la rama donde va
a trabajar. La rama main contiene la versión estable y lista para producción, mientras que la rama dev
es para desarrollo y pruebas.

```bash
git branch -r
```

y seleccionar la rama en la que quiere trabajar(dev o main)

```bash
git switch dev
```

2. **Configuracion de archivos .env**

Crea los archivos .env necesarios para la conexión entre el frontend, el backend y la base de datos.

#### Archivo principal del proyecto

Crea un archivo .env en la raíz del proyecto basándote en el archivo de ejemplo:

```bash
~/TaskFlow/.env.example
```
#### Archivo del backend (Laravel API)

Crea un archivo .env en el backend para configurar la conexión con la base de datos:

```bash
~/TaskFlow/backend/laravel-api/.env.example
```
#### Archivo del frontend (Vue SPA)

Crea un archivo .env en el frontend para definir la URL base desde donde se consumirá la API y realizar las peticiones HTTP:

```bash
~/TaskFlow/frontend/vue-SPA/.env.example
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

- Mejorar la interfaz de Vue.js para mostrar tareas y filtros.

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
