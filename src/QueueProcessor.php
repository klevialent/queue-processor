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
        foreach ($this->workers as $worker) {
            $worker->action($this->queue->fetchTasks(self::DEFAULT_COUNT_TASKS));
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
    const DEFAULT_COUNT_TASKS = 10;
}
