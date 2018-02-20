<?php

echo 'Put data to the queue' . PHP_EOL;
require(__DIR__ . '/queue-put.php');

echo PHP_EOL . 'Processing this queue' . PHP_EOL;
require (__DIR__ . '/processing.php');
