<?php

namespace Klevialent\QueueProcessor\Examples\App;

use Klevialent\QueueProcessor\WorkerInterface;


class FoobarWorker implements WorkerInterface
{
    public function action($task) : bool
    {
        $success = rand(0, 1);
        sleep(1);
        if ($success) {
            echo 'Task #' . $task->getId() . ' with data ' . json_encode($task->getData()) . ' processed.' . PHP_EOL;
            return true;
        } else {
            echo 'Task #' . $task->getId() . ' can\'t be performed. It will be done later.' . PHP_EOL;
            return false;
        }
    }
}
