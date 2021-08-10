![Banner](https://github.com/hanisirfan/seajell/blob/gh-pages/assets/GithubBanner.png)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/hanisirfan/seajell)
![GitHub release (latest by date)](https://img.shields.io/github/downloads/hanisirfan/seajell/latest/total) 
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/hanisirfan/seajell)
![GitHub](https://img.shields.io/github/license/hanisirfan/seajell)

# SeaJell
A simple e-Certificate Generator.


## Requirements
1. Access to terminal / SSH
2. Web server (Apache2, NGINX)
2. MySQL / MongoDB
3. Composer
4. NodeJS (for NPM)
5. PHP Extensions (enabled in php.ini)
   1. ext-dom
   2. ext-zip
   3. ext-gd
   4. ext-mysql
   4. etc
6. Appropriate access to web folder.

## Installation
1. Source code
 - Download the source code of this system.
 - Setup your web server (Apache/Nginx) to suit Laravel app.
 - Copy `.env.example` file and rename to `.env`. Configure the `.env` file for database connection.
 - Run `composer update`, `npm update`, `composer install`, `npm install` to update/upgrade and install necessary dependencies.
 - Run `npm run prod` to and compile the assests.
 - Generate the application key with `php artisan key:generate` command. This key will be stored in `.env` file and be used for encryption.
 - (Optional) For production environment, set the `APP_DEBUG` value to `false` to prevent sensitive config to be exposed to the user.
 - Upload the files to your web server.
 - Go to your `/install` to proceed the installation.
   The script will add a new `admin` user, migrate the database and generate the application key.
 - System installation is completed!
2. Compiled binary
 - Download the the compiled binary from the release.
 - Setup your web server (Apache/Nginx) to suit Laravel app.
 - Configure the `.env` file for database connection.
 - Generate the application key with `php artisan key:generate` command. This key will be stored in `.env` file and be used for encryption.
 - (Optional) For production environment, set the `APP_DEBUG` value to `false` to prevent sensitive config to be exposed to the user.
 - Upload the files to your web server.
 - Go to your `/install` to proceed the installation.
   The script will add a new `admin` user, migrate the database and generate the application key.
 - System installation is completed!


If you're hosting this system in a shared hosting, make sure to edit or add the `.htaccess` file containing the code below in the root folder.

```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

## License

This system/project is licensed under [GNU GPLv3](COPYING). Each contributions to this system will
be licensed under the same terms. Contributions are listed in [CREDITS](CREDITS) and the website in the future.
