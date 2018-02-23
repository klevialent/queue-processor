<?php

namespace Klevialent\QueueProcessor;

use Tarantool\Client\Client as TarantoolClient;
use Tarantool\Client\Exception\ConnectionException;
use Tarantool\Queue\Queue;


class TarantoolQueue extends Queue implements QueueInterface
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
     * @inheritdoc
     */
    public function take($timeout = null)
    {
        try {
            return parent::take($timeout);
        } catch (ConnectionException $e) {
            //this exception thrown when queue has no tasks
            if ($e->getMessage() === 'Read timed out.') {
                return null;
            }

            throw $e;
        }
    }

    public function clientDisconnect()
    {
        $this->client->disconnect();
    }

    /**
     * @var TarantoolClient
     */
    protected $client;
}
