## Steps for deployment

1.  Download and install [NodeJS 18](https://nodejs.org/en/download/prebuilt-installer)
2.  Download and install [PHP 8.1.14](https://windows.php.net/downloads/releases/archives/php-8.1.4-nts-Win32-vs16-x64.zip)
3.  Download and install [Composer](https://getcomposer.org/Composer-Setup.exe)
4.  Run your terminal
5.  cd to the file where you save this repository
6.  Make a copy of .env.example and name it .env
7.  Add your mysql environment variables in .env file
8.  Run these commands
    > composer install
    > npm install
    > php artisan migrate
    > php artisan migrate --path database/seeder
9.  open another terminal. make sure to run these 2 commands on a separate terminal
    > terminal 1
    > php artisan serve

> terminal 2
> npm run dev

### User Credentials

-   username = superadmin or superadmin@example.com
-   password = HNrtuh22pESrzCN5@
