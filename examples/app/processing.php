<?php

use Klevialent\QueueProcessor\QueuesProcessing;
use Klevialent\QueueProcessor\Examples\App\FoobarWorker;

require(__DIR__ . '/../../vendor/autoload.php');


$config = [
    'foobar' => [
        'uri' => 'tcp://tarantool:3302',
        'workers' => [
            new FoobarWorker()
        ]
    ]
];

(new QueuesProcessing($config))->run();
