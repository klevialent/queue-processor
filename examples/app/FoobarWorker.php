<?php

namespace Tucibi\TarantoolQueuePhpExtended\Examples\App;

use Tucibi\TarantoolQueuePhpExtended\WorkerInterface;


class FoobarWorker implements WorkerInterface
{
    public function action($tasks)
    {
        foreach ($tasks as $task) {
            echo "Task #{$task->getId()} with data " . json_encode($task->getData())
                . " processed by worker " . self::class . PHP_EOL;
        }
    }
}
