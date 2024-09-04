Open commend prompt

clone the repository to the desired location
https://github.com/JamesJonker/level_7.git

git clone https://github.com/JamesJonker/level_7.git

this will create a level_7 folder and within this folder there will be a Backend and blog_api folder

cd level_7

/*
2024/09/04  13:37    <DIR>          .
2024/09/04  13:37    <DIR>          ..
2024/09/04  13:37    <DIR>          Backend
2024/09/04  13:37    <DIR>          blog_app
               0 File(s)              0 bytes
               4 Dir(s)  299 859 353 600 bytes free
/*

*/ BACKEND /*

To get the backend up and running 
go into the backend directory

cd Backend
go to the aplication in the blog-api folder

cd blog-api

run composer install

*/Configure Environment/*

cp .env.example .env

*/my .env file setting/* 

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

*/once the env file has been setup/*

*/RUN THE MIGRATION/*

php artisan migrate

*/Generate Application Key/*
php artisan key:generate

start the backend
php artisan serve

*/----------------------------------------------/*


*/---- FRONTEND ----/*


Iniside the level_7 folder that was created when you did the clone there will be a Backend and blog_api folder
/*
2024/09/04  13:37    <DIR>          .
2024/09/04  13:37    <DIR>          ..
2024/09/04  13:37    <DIR>          Backend
2024/09/04  13:37    <DIR>          blog_app
               0 File(s)              0 bytes
               4 Dir(s)  299 859 353 600 bytes free
/*

while in Command prompt go into the blog_app folder

Run the comment 
npm install

*/ Once all the packages has been installed run the application/*

npm dev run



