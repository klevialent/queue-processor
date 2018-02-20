<?php

use Tarantool\Queue\Queue as TarantoolQueue;
use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Connection\StreamConnection;
use Tarantool\Client\Packer\PurePacker;

require(__DIR__ . '/../../vendor/autoload.php');


$queue = new TarantoolQueue(
    new TarantoolClient(
        new StreamConnection('tcp://tarantool:3302'),
        new PurePacker()
    ),
    'foobar');

for ($i = 0; $i < 11; $i++) {
    $task = $queue->put(["data#$i", rand(100, 999)]);
    echo "Task #{$task->getId()} added to the queue {$queue->getName()}" . PHP_EOL;
}
