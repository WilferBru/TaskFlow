## 🚀 ¿Cómo funcionaría TaskFlow?

### 1. **Registro / inicio de sesión**

- El usuario se registra o inicia sesión (autenticación con Sanctum).
- Una vez autenticado, obtiene un token para poder usar la API.

---

### 2. **Gestión de tareas**

Cada usuario puede **crear tareas** con los siguientes datos:

- **Título**
- **Descripción**
- **Estado** (por defecto: _Pendiente_)
- **Fecha límite** (_deadline_)
- **Prioridad** (por ejemplo: Alta, Media, Baja)

---

### 3. **Flujo de estados**

Cada tarea pasa por un **StateTask**, por ejemplo:

- `1 → Pendiente`
- `2 → En progreso`
- `3 → Completada`

El usuario puede cambiar el estado a medida que avanza en su trabajo.

---

### 4. **Listados y filtros (opcional)**

El frontend podrá mostrar:

- Tareas por estado.
- Tareas por **categoría** (por ejemplo: Trabajo, Personal, Estudios).
- Tareas próximas a vencer.
- Tareas completadas.
- Estadísticas de progreso (por ejemplo, cuántas tareas fueron terminadas esta semana).
