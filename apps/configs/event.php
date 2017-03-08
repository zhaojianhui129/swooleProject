<?php
$event['master'] = [
    'type' => Swoole\Queue\Redis::class,
    'async' => true,
];
return $event;
