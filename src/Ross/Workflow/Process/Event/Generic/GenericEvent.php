<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:17 PM
 */

namespace Ross\Workflow\Process\Event\Generic;


use Ross\Workflow\Exception\InvalidLinkException;
use Ross\Workflow\Process\Event\AbstractEvent;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Link\Collection\OneToOneLinkCollection;
use Ross\Workflow\Process\Link\Link;

class GenericEvent extends AbstractEvent
{
    protected $type = self::GENERIC_EVENT;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->linkCollection = new OneToOneLinkCollection($this);
    }

    public function connect(Link $link)
    {
        if ($link->getTo() === $this && $link->getFrom() instanceof EventInterface) {
            throw new InvalidLinkException("Events cannot connect to events");
        }

        if ($link->getFrom() === $this && $link->getTo() instanceof EventInterface) {
            throw new InvalidLinkException("Events cannot connect to events");
        }

        $this->linkCollection->addLink($link);
    }

    public function fire()
    {
        error_log("Event fired: {$this->getName()}");
        if (count($this->linkCollection->getOutgoing())) {
            return $this->linkCollection->getOutgoing()[0]->getTo();
        }


    }

}