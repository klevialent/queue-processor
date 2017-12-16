<?php

namespace Tucibi\TarantoolQueuePhpExtended;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Connection\Retryable;
use Tarantool\Client\Connection\StreamConnection;
use Tarantool\Client\Packer\PurePacker;


class QueueProcessor
{
    /**
     * @param array $config - Queue name(s) and Workers
     */
    public function __construct($config)
    {
        foreach ($config as $queueName => $workers) {

            //todo exceptions
            //todo add to configuration

            $this->queues[] = new TarantoolQueue(
                new TarantoolClient(
                    new Retryable(new StreamConnection()),
                    new PurePacker()
                ),
                $queueName,
                $workers
            );
        }
    }

    /**
     * Run processing all registered queues
     */
    public function run()
    {
        foreach ($this->queues as $queue) {
            $queue->process();
        }
    }

    /**
     * @var QueueInterface[]
     */
    private $queues;
}
