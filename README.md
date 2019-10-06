# Flower Bouquets
This is a console application that generates a collection of flower bouquets based on a set of bouquet design and a set
of flower species.


This application was implemented for a company code challenge. 

## Installation
### Locally
You just need to run `composer` to install the dependencies.
```php
composer install
```
### Using Docker
You just need to build a new docker container using the Dockerfile included in the root folder of the project.
```bash
docker build .
```
Please check the Docker documentation if you want to know more about it -> https://docs.docker.com/engine/reference/commandline/build/
## Usage
This application can be executed using the `run.php` file and including the input stream that the application is going to 
consume in the `/resources` folder. You need to include your input in file and pass the filename as an argument when you execute the PHP file through the console.

Please take a look into this folder, you will find some examples about the input format.

### About the source code
On the other hand, you can see that the class `\Solaing\FlowerBouquets\GenerateBouquets` has injected a `\Symfony\Component\Console\Input\StreamableInputInterface` and a 
`\Symfony\Component\Console\Output\OutputInterface`. 

It makes this code completely customizable with any kind of input or output that implements those interfaces.

I suggest you to take a look into the [Symfony Console](https://symfony.com/doc/current/components/console.html) package to get some ideas of how you can run this class.
## Running the application
Dont' forget to add your input file before you run the application ;)
### Locally
Simply run in the root folder using the php binary.
```php
php -f run.php <YOUR INPUT FILE>.txt
```
### Using Docker
Same idea but we need to execute the command in the container and redirect the std output.
```php
docker exec -it <CONTAINER ID OR NAME> bash -c "php -f run.php <YOUR INPUT FILE>.txt 2>&1"
```
## Running Tests
This application is completely tested to be sure everything works fine and to give the reader some help to understand 
the implementation.
### Locally
Simply run the PHPUnit binary located in the `vendor` folder.
```php
vendor/bin/phpunit
```
### Using Docker
Same idea but we need to execute the command in the container and redirect the std output.
```php
docker exec -it <CONTAINER ID OR NAME> bash -c "vendor/bin/phpunit 2>&1"
```