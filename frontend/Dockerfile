FROM node:16.13.1-alpine3.14

WORKDIR /app

ADD package.json /app

RUN apk update && apk upgrade
RUN apk add git 
RUN apk --no-cache --virtual build-dependencies add \
  python3 \
  make \
  g++

COPY . /app


RUN yarn
RUN yarn build

CMD [ "yarn", "dev" ]