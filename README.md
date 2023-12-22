# Fabbi test
```
http://localhost:8080/
```

### Information
````
 - php v8.1.26
 - nodejs v20.10.0
 - npm v10.2.3
 - laravel v10.37.3
 - jquery v3.7.1 cnd
 - tailwind css v3.4.0
````
### Installation
#### Clone code:
````
https://github.com/18Dev/fabbi_test.git
or ssh key
git@github.com:18Dev/fabbi_test.git

cd fabbi_test
cp .env.example .env
````

#### Run docker:
````
docker-compose up -d
````

#### Create key in .env laravel:
````
docker exec -it fabbi_test bash
php artisan key:generate
````

#### Run npm:
````
docker exec -it node bash
npm run dev -- --host
````
