<?php

$config = [
    'components' => [
        
        //minimal
        'queue' => [
            'class' => \Klevialent\QueueProcessor\yii\QueuesManager::className(),
            'client' => \Klevialent\QueueProcessor\TarantoolClient::class,
            'queues' => ['foobar'],
        ],
        
        //extended with defaults
        'queueExtended' => [
            'class' => \Klevialent\QueueProcessor\yii\QueuesManager::className(),
            'client' => [
                'class' => \Klevialent\QueueProcessor\TarantoolClient::class,
                'queue' => \Klevialent\QueueProcessor\TarantoolQueue::class,
                'connection' => [
                    'class' => \Tarantool\Client\Connection\StreamConnection::class,
                    'url' => 'tcp://127.0.0.1:3301',
                ],
                'packer' => \Tarantool\Client\Packer\PurePacker::class,
            ],
            'queues' => ['foobar'],
        ],
        
    ],
];

return $config;
