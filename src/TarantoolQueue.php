<?php

namespace Klevialent\QueueProcessor;

use Tarantool\Client\Exception\ConnectionException;
use Tarantool\Queue\Queue;


class TarantoolQueue extends Queue implements QueueInterface
{
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
}
