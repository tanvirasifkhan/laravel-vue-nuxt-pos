## About The Project  

This project is basically a Laravel POS app built using PHP/Laravel 11, MySQL, VueJS, TypeScript and TailwindCSS 4. This project is built using Monorepo approach which contains backend, frontend in the same repository. It contains features like category management, product management, supplier management, purchase and supplier ledger management etc. Each module has the search feature. Some of the modules have CRUD features with pagination as well. Purchase module is responsible for product stocking. Supplier ledger module is basically for supplier purchase payment.

## Tech Stack used for this project

1. PHP 8.3
2. MySQL 8.0
3. phpMyadmin 5.2
4. Laravel 11
5. Node 22 LTS
6. VueJS 3 with Composition API
7. TypeScript for VueJS
8. Pinia for VueJS state management
9. TailwindCSS 4 for frontend design
10. Docker 27
11. Ubuntu 24.04 LTS as OS
12. REST API using SOLID Design Pattern 

## Necessary Softwares to Download

Since I am a Ubuntu OS user, I used Ubuntu 24.04 LTS for development. Linux OS is very important to run this application. You can install Ubuntu 24.04 LTS or you can configure WSL(Windows Subsystem for Linux) if you are already a Windows OS user.

Docker is the main backbone of this application. Without the proper installation and configuration, this application can not be run. Docker should be running in the background. You can check it by using `docker ps` and `sudo systemctl status docker` commands.You can follow the link given below to install and configure Docker.

https://docs.docker.com/engine/install/ubuntu/

We need to install and configure **PHP 8.3** and [Composer](https://getcomposer.org/download/) for PHP package management in your local system as well.After installation, you can check it by `composer --version` command.

After that install and configure [NodeJS](https://nodejs.org/en). You can use the [NVM](https://github.com/nvm-sh/nvm) to install and configure NodeJs. 

**Follow the commands to install NodeJS easily**

`wget -qO- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash`

Restart your terminal and run the following commands

`nvm install --lts` and `nvm current` you are done. You can check it by using `node --version` and `npm --version` commands.

After the successful installation and configuration of all the softwares, you are good to go.

## How to get the project live

To get the application up and running you need to follow couple of steps. Lets go with the steps one by one

### STEP #1:  Clone the github repository

First you need to clone the Github repository from the link given below 

https://github.com/tanvirasifkhan/laravel-vue-nuxt-pos

and `cd /laravel-vue-nuxt-pos`

**For Backend follow the commands**

1. `cd backend`
2. `touch .env` and `cp .env.example .env`
3. `composer install`
4. `php artisan key:generate`

**For Frontend follow the commands**

1. `cd frontend`
2. `touch .env` and `cp .env.sample .env`
3. `npm install`

 and `cd /laravel-vue-nuxt-pos`
 
### STEP #2:  Building Docker Image
 
then build the docker using `docker compose up -d` command from the root folder. It will take some time based on your internet connection to complete. After building the Docker there will be 

**Four Containers ( Running on ports )**

1. pos-backend (http://localhost:8000)
2. pos-frontend (http://localhost:5173)
3. pos-database-server (http://localhost:3306)
4. pos-database-admin-panel (http://localhost:8080)

**Important Note**

If mysql server is already running on your system at `3306` port then it will conflict with the docker mysql server. Because mysql server docker container also configured to run on port `3306`. So you need to stop the local mysql server by using `sudo systemctl stop mysql` and `sudo systemctl disable mysql`. After that run `docker compose down` and `docker compose up -d`. It should all be running fine in your system. So all your docker containers are running fine.

### STEP #3:  Configure The Backend API Database

Now its time to configure backend `.env` file. Configure your database credentials like below and keep it as it is

```
DB_CONNECTION=mysql
DB_HOST=database-server
DB_PORT=3306
DB_DATABASE=pos
DB_USERNAME=root
DB_PASSWORD=
```

Now access your `phpMyadmin` panel inside your browser on port `localhost:8080` and create a database called `pos`.

Then from the root folder of your project run `docker exec pos-backend php artisan migrate` command to create all the tables in the database. Then run `docker exec pos-backend php artisan db:seed` to prepopulate dummy datas (Category, Product, Supplier module).

Now guess what, you are good to access the whole application in the browser.

1. Enter `localhost:8000` for backend
2. Enter `localhost:5173` for frontend
3. Enter `localhost:8080` for database phpMyadmin panel

You can now play around with the application.

Hope, the application runs smoothly. Enjoy and thanks





