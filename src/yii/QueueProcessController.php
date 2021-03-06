<?php

namespace Klevialent\QueueProcessor\yii;

class QueueProcessController extends \yii\console\Controller
{
    public function actionIndex($queueName)
    {
        $worker = $this->queuesNamespace . '\\' . ucfirst($queueName) . 'Worker';

        if (! class_exists($worker)) {
            throw new \InvalidArgumentException("Unknown worker for queue \"$queueName\". You must define class \"$worker\".");
        }

        (new $worker())->process();
    }

    public $queuesNamespace = '\\console\\workers';
}
