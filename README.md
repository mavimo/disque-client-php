# Disque client for PHP

The current project is a PHP client for [disque](https://github.com/antirez/disque). As specified in the project page disque is ongoing experiment to build a distributed, in memory, message broker. Its goal is to capture the essence of the "Redis as a jobs queue" use case.

**WARNING: Like disque this project alpha code NOT suitable for production. The implementation and API will likely change in significant ways during the next months. The code and algorithms are not tested enough. A lot more work is needed.**

## Installing via Composer

The recommended way to install disque client is through [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest version of Disque Client:

```bash
composer.phar require mavimo/disque-client
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Usage

This is a simple code snippet on how to use the Disque Client:

```php
require 'vendor/autoload.php';

$socket = new Mavimo\Disque\Client\Socket('127.0.0.1', 7711);
$client = new Mavimo\Disque\Client\Client($socket);

$queue = new Mavimo\Disque\Queue\Queue('mytest');

$body = json_encode([
    'foo' => true,
    'bar' => 'Lorem ipsum',
]);

$jobA = new Mavimo\Disque\Job\Job($body);
$jobB = new Mavimo\Disque\Job\Job($body);
$jobC = new Mavimo\Disque\Job\Job($body);

$client->push($queue, $jobA);
var_dump($jobA);
$client->push($queue, $jobB);
var_dump($jobB);
$client->push($queue, $jobC);
var_dump($jobC);

$job1 = $client->fetch($queue);
var_dump($job1);
$job2 = $client->fetch($queue);
var_dump($job2);
$job3 = $client->fetch($queue, 1);
var_dump($job3);
$job4 = $client->fetch($queue, 1);
var_dump($job4);
```
