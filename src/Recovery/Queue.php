<?php

namespace mgdm\Recovery;

/**
 * Class Queue
 * @package mgdm\Recovery
 */
class Queue
{
    /**
     * @var Driver
     */
    protected $driver;

    /**
     * @var array
     */
    protected $queues;

    /**
     * @param Driver $driver
     * @param array $queues
     */
    public function __construct(Driver $driver, array $queues)
    {
        $this->driver = $driver;
        $this->queues = $queues;
    }

    public function enqueue($queue, $class, array $arguments = null)
    {
        if (!in_array($queue, $this->queues)) {
            throw new \InvalidArgumentException("This object is not monitoring queue {$queue}");
        }

        $job = new stdClass;
        $job->class = $class;
        $job->arguments = $arguments;

        return $this->driver->enqueue($queue, $job);
    }
}