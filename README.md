# Tuzex / Cqrs

Common interfaces for implementing the CQRS (Command Query Responsibility Segregation) pattern.

Installation
------------

The best way to install Tuzex/cqrs is using the [Composer](http://getcomposer.org/):

```sh
$ composer require tuzex/cqrs
```

Testing
------------

Validate composer

```sh
$ docker run --rm -v $PWD:/app -w /app -u 1000:1000 composer composer validate --no-check-all --strict
```

Static analysis

```sh
$ docker run --rm -v $PWD:/app -w /app -u 1000:1000 php:7.4-cli vendor/bin/phpstan analyse src -l max -c phpstan.neon
```

Coding standards

```sh
$ docker run --rm -v $PWD:/app -w /app -u 1000:1000 php:7.4-cli vendor/bin/ecs check src --config ecs.php
$ docker run --rm -v $PWD:/app -w /app -u 1000:1000 php:7.4-cli vendor/bin/ecs check src --config ecs.php --fix
```
