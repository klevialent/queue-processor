<?php

namespace Klevialent\QueueProcessor;


use Tarantool\Queue\Task;

interface QueueInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $data
     * @param array $options
     *
     * @return Task
     */
    public function put($data, array $options = []);

    /**
     * @param int|float|null $timeout
     *
     * @return Task
     */
    public function take($timeout = null);

    /**
     * @param int $taskId
     *
     * @return Task
     */
    public function ack($taskId);

    /**
     * @param int $taskId
     * @param array $options
     *
     * @return Task
     */
    public function release($taskId, array $options = []);
}
