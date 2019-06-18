git config --global http.sslVerify false
git clone https://gitlab.terengganu.gov.my/mohdazhar/portal.git
composer update
copy .env.example .env
php artisan key:generate
php artisan ide-helper:generate
php artisan ide-helper:meta
php artisan migrate
php artisan serve
git pull
git config --global user.email "msyazwans@gmail.com"
git config --global user.name "msyazwans"
git stash
php artisan cache:clear
php artisan config:clear

composer require unisharp/laravel-ckeditor
php artisan vendor:publish
--kna buat pilihan mana nak publish

git add .
git commit -m "latest"
git push -u msyazwans master