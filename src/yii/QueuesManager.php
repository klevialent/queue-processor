<?php

namespace tucibi\tarantoolQueuePhp\yii;

use tucibi\tarantoolQueuePhp\ClientInterface;

class QueuesManager extends \yii\base\Component
{
    /**
     * @var ClientInterface|array|string
     */
    public $client;
 
    public $queues;

    public function init()
    {
        parent::init();

        if (! $this->client instanceof ClientInterface) {
            $options = $this->client;
            if (! is_array($options)) {
                $options = ['class' => $options];
            }
            
            $this->client = $options['class']::createObject($options);
        }
    }

    public function __get($name)
    {
        if (in_array($name, $this->queues)) {
            $queueName = $name;
        } else if (array_key_exists($name, $this->queues)) {
            $queueName = array_key_exists('queue', $this->queues[$name]) ? $this->queues[$name]['queue'] : $name;
        } else {
            return parent::__get($name);
        }

        return $this->client->getQueue($queueName);
    }
}
