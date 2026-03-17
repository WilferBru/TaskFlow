FROM node:20-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

# Se copia url de la api
RUN cp .env.production .env

RUN npm run build

ENV HOST=0.0.0.0

EXPOSE 4173

CMD ["npm", "run", "preview"]
