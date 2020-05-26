# Chupi project

> El proyecto más guay habido y por haber.

En cada ejecución el programa te devuelve una frase molona!!

## Para levantar un servidor web
``
php -S localhost:8000 chupi.php
``

## Realizar una solicitud GET
``
curl --location --request GET 'http://localhost:8000/colorword'
``

## Endpoints 
### Color
- Devuelve un color aleatorio
``
http://localhost:8000/color
``
### Cool Word
- Devuelve una palabra molona aleatoria
``
http://localhost:8000/coolword
``
### Cool Word with style
- Devuelve un json con un color de fondo aleatorio, un color de fuente aleatoria y una palabra molona también aleatoria
``
http://localhost:8000/colorword
``

## Test
### Unit test
- Ejecutar unit test en linea de comandos:
``
vendor/bin/phpunit
``
- Ejecutar unit test en linea de comandos con estilo:
``
vendor/bin/phpunit --testdox
``

### Behat
- Ejecutar test Behat en linea de comandos:
``
vendor/bin/behat
``
- Ejecutar test Behat en linea de comandos con estilo:
``
vendor/bin/behat --colors
``
``
vendor/bin/behat --format=progress
``