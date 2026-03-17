FROM node:20-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

# Recibe la variable desde el build
ARG VITE_API_URL
ENV VITE_API_URL=$VITE_API_URL

RUN npm run build

ENV HOST=0.0.0.0

EXPOSE 4173

CMD ["npm", "run", "preview"]