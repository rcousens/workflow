<?php

namespace Ross\Workflow\Process\Rule\Process\Negative;


use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class NoEventToEvent
{
    public function rule(ProcessInterface $process, Link $link)
    {
        if ($process instanceof EventInterface && $link->getFrom() === $process && $link->getTo() instanceof EventInterface) {
            throw new \RuntimeException("Events cannot be linked to each other");
        }
    }

}