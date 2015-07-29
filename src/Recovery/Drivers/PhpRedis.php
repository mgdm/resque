<?php

namespace mgdm\Recovery\Drivers;

use mgdm\Recovery\Driver;

class PhpRedis implements Driver
{
    private $redis;

    private $timeout;

    public function __construct(\Redis $redis, $timeout = 10)
    {
        $this->redis = $redis;
        $this->timeout = $timeout;
    }

    public function enqueue($queue, $job)
    {
        $result = $this->redis->rPush($queue, $job);

        if ($result === false) {
            throw new \Exception("Failed to enqueue job");
        }
    }

    public function await(array $queues)
    {
        $result = $this->redis->blpop($queues, $this->timeout);
        return $result['item'];
    }
}