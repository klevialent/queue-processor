<?php

namespace Tucibi\TarantoolQueuePhpExtended;


interface QueueInterface
{
    /**
     * Fetch some tasks and do it
     */
    public function process();
}
