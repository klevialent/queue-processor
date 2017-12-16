<?php

namespace Tucibi\TarantoolQueuePhpExtended;


interface WorkerInterface
{
    /**
     * @param \Tarantool\Queue\Task[] $tasks
     */
    public function action($tasks);
}
