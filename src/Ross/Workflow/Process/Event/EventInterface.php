<?php

namespace Ross\Workflow\Process\Event;

use Ross\Workflow\Process\ProcessInterface;

interface EventInterface extends ProcessInterface
{

    public function fire();

    public function getType();
}