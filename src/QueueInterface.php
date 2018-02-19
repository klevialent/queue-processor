<?php

namespace Klevialent\QueueProcessor;


interface QueueInterface
{
    public function fetchTasks($limit);
}
