FROM node:22.13-alpine3.21

RUN apk update && apk upgrade && apk add git bash

WORKDIR /web

COPY package*.json ./

RUN npm install

COPY . ./

CMD [ "npm", "run", "dev" ]