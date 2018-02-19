<?php

namespace Klevialent\QueueProcessor;


interface WorkerInterface
{
    /**
     * @param \Tarantool\Queue\Task[] $tasks
     */
    public function action($tasks);
}
