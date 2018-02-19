<?php

namespace Klevialent\QueueProcessor;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Queue\Task;


class TarantoolQueue extends \Tarantool\Queue\Queue implements QueueInterface
{
    /**
     * @param TarantoolClient $client
     * @param string $name
     */
    public function __construct($client, $name)
    {
        parent::__construct($client, $name);

        $this->client = $client;
    }

    /**
     * @param int $limit
     *
     * @return Task[]
     */
    public function fetchTasks($limit)
    {
        $this->client->connect();
        $tasks = [];
        while ($limit > 0) {
            if (! ($task = $this->take())) break;

            $tasks[] = $task;
            $limit--;
        }

        $this->client->disconnect();

        return $tasks;
    }


    /**
     * @var TarantoolClient
     */
    protected $client;


    //todo configurable
    const DEFAULT_COUNT_TASKS = 10;
}
