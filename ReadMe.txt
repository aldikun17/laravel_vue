referral using laravel api + vue.js
if composer is not installed please install composer.org

to run if you have wampp or xampp
paste it to www/htdocs
run cmd go to directory path. //cd /wamp64/www/referrals or cd /xampp/htdocs/referrals

if error pointing vendor please run the command in cmd in directory path
c:wamp64/www/refferals: composer update.


edit env file for database credentials and database name,


to migrate tables in the databasename please use:
c:wamp64/www/refferals: php artisan migrate
it will deploy all tables in the database.

and to deploy api project. please run in  the cmd in directory path php artisan serve,
c:wamp64/www/refferals: php artisan serve
command will execute and i will give u a 127.0.0.1:8000 for url of the deployment
