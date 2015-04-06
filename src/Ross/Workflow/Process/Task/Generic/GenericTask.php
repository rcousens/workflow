<?php

namespace Ross\Workflow\Process\Task\Generic;


use Ross\Workflow\Exception\InvalidLinkException;
use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Link\Collection\OneToOneLinkCollection;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\Task\AbstractTask;
use Ross\Workflow\Process\Task\TaskInterface;

class GenericTask extends AbstractTask
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->linkCollection = new OneToOneLinkCollection($this);
    }

    public function connect(Link $link)
    {
        if ($link->getFrom() === $this && $link->getTo() instanceof TaskInterface) {
            throw new InvalidLinkException("Tasks cannot link to other tasks");
        }

        if ($link->getTo() === $this && $link->getFrom() instanceof TaskInterface) {
            throw new InvalidLinkException("Task cannot link to other tasks");
        }

        $this->linkCollection->addLink($link);
    }
}