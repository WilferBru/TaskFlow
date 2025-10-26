<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## API de TaskFlow (Backend Laravel)

Este backend fue desarrollado con **Laravel 12** y funciona como la base de datos y lógica de negocio de la aplicación **TaskFlow**, un sistema de gestión de tareas con autenticación, roles y control de permisos.

## Tecnologías principales

-   **Framework:** Laravel 12
-   **Autenticación:** Laravel Sanctum
-   **Base de datos:** PostgresSQL
-   **Contenedores:** Docker Compose
-   **PHP:** 8.2-fpm
-   **Puerto expuesto:** 8000

## Autenticación

La API usa laravel Sanctum para manejar el inicio de sesion y la proteccion de rutas con tokens personales.

**Endpoints de autenticación**

| Método | Ruta            | Descripción                                               | Autenticación |
| ------ | --------------- | --------------------------------------------------------- | ------------- |
| `POST` | `/api/register` | Registra un nuevo usuario                                 | No requerida  |
| `POST` | `/api/login`    | Inicia sesión y devuelve un token                         | No requerida  |
| `POST` | `/api/logout`   | Cierra sesión (invalida el token)                         | Requerida     |
| `GET`  | `/api/profile`  | Obtener datos del usuario autenticado (invalida el token) | Requerida     |

## Usuarios (/api/users)

| Método   | Ruta                | Descripción                    | Rol        |
| -------- | ------------------- | ------------------------------ | ---------- |
| `GET`    | `/api/users`        | Listar los usuarios            | admin      |
| `POST`   | `/api/users`        | Crear un uevo suario           | admin      |
| `GET`    | `/api/users/{user}` | Muestra detalles de un usuario | admin/user |
| `PUT`    | `/api/users/{user}` | Actualizar usuario             | admin/user |
| `DELETE` | `/api/users/{user}` | Eliminar usuario o cuenta      | admin/user |

## Estado de tareas (/api/states)

| Método   | Ruta                  | Descripción                  | Rol   |
| -------- | --------------------- | ---------------------------- | ----- |
| `GET`    | `/api/states`         | Listar los estados de task   | admin |
| `POST`   | `/api/states`         | Crear un estado de task      | admin |
| `PUT`    | `/api/states/{state}` | Actualizar un estado de task | admin |
| `DELETE` | `/api/states/{state}` | Eliminar un estado de task   | admin |

## Categorias (/api/categories)

| Método   | Ruta                         | Descripción                      | Rol   |
| -------- | ---------------------------- | -------------------------------- | ----- |
| `GET`    | `/api/categories`            | Listar las categorias de task    | admin |
| `POST`   | `/api/categories`            | Crear una categoria de task      | admin |
| `PUT`    | `/api/categories/{category}` | Actualizar una categoria de task | admin |
| `DELETE` | `/api/categories/{category}` | Eliminar una categoria de task   | admin |

## Tareas (/api/tasks)

| Método   | Ruta                | Descripción                                  | Rol        |
| -------- | ------------------- | -------------------------------------------- | ---------- |
| `GET`    | `/api/tasks`        | Listar las tareas                            | admin/user |
| `GET`    | `/api/tasks/{task}` | Mostrar detalles de unas tarea               | admin/user |
| `GET`    | `/api/tasks/filter` | Buscar tareas por titulo, estado o categoria | admin/user |
| `POST`   | `/api/tasks`        | Crear una tarea                              | admin/user |
| `PUT`    | `/api/tasks/{task}` | Actualizar una tarea                         | admin/user |
| `DELETE` | `/api/tasks/{task}` | Eliminar una tarea                           | admin/user |

## Observaciones

-   Todas las rutas protegidas requieren el envío del **token Bearer** obtenido al iniciar sesión.
-   Para las rutas `POST` y `PUT`, los campos deben enviarse en formato **JSON** dentro del body, puede guiarse por los campos de las tablas en la base de datos.
-   El proyecto incluye **seeders** que crean un usuario administrador por defecto:
    ```bash
    email: prueba@prueba.com
    password: prueba123
    ```

### La api estara disponible en

[localhost/api](http://localhost/api/)
