<?php

namespace console\workers;

use Klevialent\QueueProcessor\yii\AbstractWorker;
use Klevialent\QueueProcessor\TarantoolQueue;

/**
 * @property TarantoolQueue $queue
 */
class FoobarWorker extends AbstractWorker
{
    public function process()
    {
        while (true) {
            $task = $this->queue->take();
            if (empty($task)) {
                $this->client->disconnect();
                echo 'sleep' . PHP_EOL;
                sleep(10);
                continue;
            }

            echo $task->getId() . ' : ' . $task->getData() . ' : ' . $task->getState() . PHP_EOL;

            $this->queue->ack($task->getId());
        }
    }
}
