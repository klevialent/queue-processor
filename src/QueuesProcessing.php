<?php

namespace Klevialent\QueueProcessor;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Connection\StreamConnection;
use Tarantool\Client\Packer\PurePacker;


class QueuesProcessing
{
    /**
     * @param array $config
     */
    public function __construct($config)
    {
        foreach ($config as $queueName => $options) {

            if (is_array($options)) {
                $uri = array_key_exists('uri', $options) ? $options['uri'] : null;
                $workers = $options['workers'];
            } else {
                $uri = null;
                $workers = $options;
            }

            $this->queueProcessors[] = new QueueProcessor(
                new TarantoolQueue(
                    new TarantoolClient(
                        new StreamConnection($uri),
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
