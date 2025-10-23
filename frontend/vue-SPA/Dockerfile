# Imagen base de node
FROM node:20-alpine

# Directorio de trabajo dentro del contenedor
WORKDIR /app

# Copiar archivos de dependencias
COPY package*.json ./

# Instalar dependencias (dev + prod)
RUN npm install

# Copiar todo el proyecto
COPY . .

# Exponer el puerto donde Vite corre por defecto
EXPOSE 5173

# Comando para levantar el servidor de desarrollo con hot reload
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]