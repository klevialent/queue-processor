<?php

namespace Klevialent\QueueProcessor;


interface WorkerInterface
{
    /**
     * @param \Tarantool\Queue\Task $task
     *
     * @return bool - result of task execution
     */
    public function action($task) : bool;
}
