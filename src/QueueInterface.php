<?php

namespace Tucibi\TarantoolQueuePhpExtended;


interface QueueInterface
{
    public function fetchTasks($limit);
}
