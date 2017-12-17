<?php

namespace Tucibi\TarantoolQueuePhpExtended;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Connection\Retryable;
use Tarantool\Client\Connection\StreamConnection;
use Tarantool\Client\Packer\PurePacker;


class QueuesProcessing
{
    /**
     * @param array $config - Queue names and Workers
     */
    public function __construct($config)
    {
        foreach ($config as $queueName => $workers) {

            //todo exceptions
            //todo add to configuration

            $this->queueProcessors[] = new QueueProcessor(
                new TarantoolQueue(
                    new TarantoolClient(
                        new Retryable(new StreamConnection()),
                        new PurePacker()
                    ),
                    $queueName
                ),
                $workers
            );
        }
    }

    /**
     * Run processing all registered queues
     */
    public function run()
    {
        foreach ($this->queueProcessors as $queueProcessor) {
            $queueProcessor->process();
        }
    }

    /**
     * @var QueueProcessor[]
     */
    private $queueProcessors;
}
