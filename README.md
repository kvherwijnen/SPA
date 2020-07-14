# Project Sheep AI <img style="align: right; float: right" src="https://img.shields.io/badge/php-%5E7.2.5-purple" alt="PHP Version"><img align="right" width="270" height="auto" src="https://i.ya-webdesign.com/images/png-black-sheep-18.png" />
#### First set-up
Follow the instructions to run the project yourself for development.

$ `composer install`

$ `npm install`
***
 
#### Create a .env File
```textmate
Copy .env.example to .env 
Fill in the database settings
```

#### Set the Application Keys & prepare database
$ `php artisan key:generate`

$ `php artisan jwt:secret`

$ `php artisan migrate:refresh —seed`

$ `composer dump-autoload`
***
#### Run the project

$ `npm run watch`
*** 
Now, a window wil open and every time you edit something it wil automaticly compile and reload

### Development Team

* **Levi Deurloo** - *HBO-ICT* - [levideurloo](https://github.com/levideurloo)
* **Kevin van Herwijnen** - *KING-DIGGING* - [kvherwijnen](https://github.com/kvherwijnen)
