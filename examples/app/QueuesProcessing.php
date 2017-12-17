<?php

use Tucibi\TarantoolQueuePhpExtended\QueuesProcessing;
use Tucibi\TarantoolQueuePhpExtended\Examples\App\FoobarWorker;

require(__DIR__ . '/../../vendor/autoload.php');


$config = ['foobar' => [new FoobarWorker()]];

(new QueuesProcessing($config))->run();
