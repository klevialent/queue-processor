<?php

namespace Tucibi\TarantoolQueuePhpExtended;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Queue\Task;


class TarantoolQueue extends \Tarantool\Queue\Queue implements QueueInterface
{
    /**
     * @param TarantoolClient $client
     * @param string $name
     * @param WorkerInterface[] $workers
     */
    public function __construct($client, $name, $workers = [])
    {
        parent::__construct($client, $name);

        $this->client = $client;
        $this->workers = $workers;
    }

    /**
     * @inheritdoc
     */
    public function process()
    {
        foreach ($this->workers as $worker) {
            $worker->action($this->fetchTasks(self::DEFAULT_COUNT_TASKS));
        }
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

    /**
     * @var WorkerInterface[]
     */
    private $workers;


    //todo configurable
    const DEFAULT_COUNT_TASKS = 10;
}
