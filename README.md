# TrTool
TrTool is a web application tool that offers market simulation with known factors and events to help both beginners and advanced traders develop their experience and knowledge risk-free.


git clone https://github.com/BorisStoyanv/TrTool.git
cd TrTool
composer install
touch database/database.sqlite
configure .env-example - .env
composer init
add this in composer.json - 

 "autoload": {
        "files": [
            "app/helpers.php"
        ] 
    },
    
composer dump-autoload
php artisan key:generate
npm install 
npm run dev
php artisan serve
http://localhost:8000 :)

