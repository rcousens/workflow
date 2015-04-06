<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:16 PM
 */

namespace Ross\Workflow\Process\Event\Start;


use Ross\Workflow\Exception\InvalidLinkException;
use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Event\AbstractEvent;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Link\Collection\NoneToOneLinkCollection;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class StartEvent extends AbstractEvent
{
    protected $type = self::START_EVENT;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->linkCollection = new NoneToOneLinkCollection($this);
    }

    public function fire()
    {
        $this->trigger();
        return $this->linkCollection->getOutgoing()->getTo();
    }

    public function connect(Link $link)
    {
        if ($this->linkCollection->hasLink($link)) {
            return;
        }

        if ($this->linkCollection->getOutgoing() instanceof Link) {
            throw new InvalidLinkException("Start event {$this->getName()} already has outgoing link");
        }

        if (! $link->getFrom() === $this) {
            throw new InvalidLinkException("Start event {$this->getName()} must be set as from side of link");
        }

        if ($link->getFrom() === $this && $link->getTo() instanceof EventInterface) {
            throw new InvalidLinkException("Start event {$this->getName()} cannot be connected to other events");
        }

        $this->linkCollection->addLink($link);
    }
}