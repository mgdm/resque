<?php

namespace mgdm\Recovery;

class Job
{
    private $class;
    private $arguments;

    public function __construct($class, array $arguments = null)
    {
        $this->class = $class;
        $this->arguments = $arguments;
    }
}