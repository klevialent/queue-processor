<?php

use Tarantool\Queue\Queue as TarantoolQueue;
use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Connection\StreamConnection;
use Tarantool\Client\Packer\PurePacker;

require(__DIR__ . '/../../vendor/autoload.php');


$queue = new TarantoolQueue(
    new TarantoolClient(
        new StreamConnection(),
        new PurePacker()
    ),
    'foobar');

for ($i = 0; $i < 11; $i++) {
    $queue->put(["data#$i", rand(100, 999)]);
}
