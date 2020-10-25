## DEVELOPMENT TOOLS
~~~
* OS:               Ubuntu 18.04.5 LTS
* PHP:              PHP 7.4.11 (cli)
* Nginx:            nginx/1.18.0
* Composer:         Composer version 1.10.13
* Docker:           Docker version 19.03.6, build 369ce74a3c
* Docker Compose:   docker-compose version 1.21.2, build a133471
* IDE:              Visual Studio Code
~~~

## INSTALL DEPENDENCES
```sh
# Run in the project root
$ composer install
```

## RUN
```sh
# With Docker
# Previously run 'composer install'
$ docker-compose up -d --build

# Running in your browser on http://localhost:8080/
```

## TEST
```sh
# With Docker
# Previously run 'composer install'
$ docker-compose up -d --build
$ docker exec -it app php vendor/bin/phpunit

# Running in your browser on http://localhost:8080/
```

## TODO
~~~
* Document functions
* Improve TDD testing
* Change root permissions in docker image
* Attribute visibility?
~~~
