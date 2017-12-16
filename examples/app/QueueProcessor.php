<?php

use Tucibi\TarantoolQueuePhpExtended\QueueProcessor;
use Tucibi\TarantoolQueuePhpExtended\Examples\App\FoobarWorker;

require(__DIR__ . '/../../vendor/autoload.php');


$config = ['foobar' => [new FoobarWorker()]];

(new QueueProcessor($config))->run();
