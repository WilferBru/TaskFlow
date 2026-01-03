<p align="center">
  <img src="https://vuejs.org/images/logo.png" width="120" alt="Vue Logo">
</p>

<h1 align="center">TaskFlow Frontend (Vue + TypeScript)</h1>

## En desarrollo

Este módulo corresponde al **frontend** del proyecto **TaskFlow**, una aplicación de gestión de tareas con autenticación, roles y control de permisos.  
Actualmente se encuentra **en desarrollo activo**, integrando la API construida en Laravel y ejecutándose dentro de contenedores **Docker**.

## Tecnologías principales

- **Framework:** Vue 3
- **Lenguaje:** TypeScript
- **Módulo HTTP:** Axios
- **Enrutamiento:** Vue Router
- **Estado global:** Pinia (planeado)
- **Estilos:** TailwindCSS
- **Backend:** Laravel 12 (API REST)
- **Contenedores:** Docker + Docker Compose
- **Puerto expuesto:** 5173

## Estado actual

- Configuración inicial de Vue + TypeScript
- Autenticacion mediante axios y pinia
- Módulos planeados:
  - Autenticación (login / registro / token) -> Echo ✅
  - Panel de tareas
  - Filtros por estado y categoría
  - Gestión de usuarios y roles

## 🐳 Ejecución con Docker

Este frontend se ejecuta como parte del entorno Docker Compose del proyecto **TaskFlow**.  
Para levantar el servicio completo (backend + frontend + base de datos), simplemente usa:

```sh
docker compose up -d --build
```

### Url del frontend disponible en

[localhost:5173/](http://localhost:5173/)
