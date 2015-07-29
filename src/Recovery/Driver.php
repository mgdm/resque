<?php
namespace mgdm\Recovery;

interface Driver
{
    public function enqueue($queue, $job);
}