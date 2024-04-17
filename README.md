# Laravel example
## Install api:
- pull repository
- cd laravel
- docker compose up -d
- Enter into pgadmin from a browser http://localhost:5050/
    Email: admin@email.com
    Password: adminpassword
- Right click on servers choose Register.
    General Tab - Name: test
    Connection Tab - Host name = postgres
    Connection Tab - Port = 5432
    Connection Tab - Maintenance Database = postgres
    Connection Tab - Username = admin
    Connection Tab - Password = adminpassword
- Create database named "laravel_practice".
- Enter the laravel container and run the following commands: docker exec -it laravel bash
    cd api
    composer install
    php artisan migrate:refresh
    php artisan db:seed
- For api calls, you use the postman collection in the root of the repo.
    laravel_practice.postman_collection.json
