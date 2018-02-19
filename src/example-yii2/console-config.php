<?php

$config = [
    'controllerMap' => [
        
        //minimal
        'queue-process' => \Klevialent\QueueProcessor\yii\QueueProcessController::className(),
        
        //extended with defaults
        'queue-process-changed-namespace' => [
            'class' => \Klevialent\QueueProcessor\yii\QueueProcessController::className(),
            'queuesNamespace' => '\\console\\workers'
        ]
        
    ],
];

return $config;
