<?php

namespace Klevialent\QueueProcessor;


class QueueProcessor
{
    /**
     * @param QueueInterface $queue
     * @param WorkerInterface[] $workers
     */
    public function __construct($queue, $workers = [])
    {
        $this->queue = $queue;
        $this->workers = $workers;
    }

    /**
     * @inheritdoc
     */
    public function process()
    {
        echo 'Run processing queue ' . $this->queue->getName() . '.' . PHP_EOL;
        foreach ($this->workers as $worker) {
            echo 'Run worker ' . get_class($worker) . '.' . PHP_EOL;
            while (true) {
                $task = $this->queue->take();
                if (empty($task)) {
                    echo 'Queue has no ready tasks. Sleep ' . self::DEFAULT_RETRY_TIMEOUT . ' seconds.'. PHP_EOL;
                    sleep(self::DEFAULT_RETRY_TIMEOUT);
                    $this->queue->clientDisconnect();
                    continue;
                }

                if ($success = $worker->action($task)) {
                    $this->queue->ack($task->getId());
                } else {
                    $this->queue->release($task->getId(), ['delay' => self::DEFAULT_TASK_EXECUTION_DELAY]);
                }
            }
        }
    }


    /**
     * @var QueueInterface
     */
    private $queue;

    /**
     * @var WorkerInterface[]
     */
    private $workers;


    //todo configurable

    const DEFAULT_RETRY_TIMEOUT = 10;

    const DEFAULT_TASK_EXECUTION_DELAY = 10;
}
