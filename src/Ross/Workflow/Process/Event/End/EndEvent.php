<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:16 PM
 */

namespace Ross\Workflow\Process\Event\End;


use Ross\Workflow\Exception\InvalidLinkException;
use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Event\AbstractEvent;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Link\Collection\OneToNoneLinkConnection;
use Ross\Workflow\Process\Link\Link;

class EndEvent extends AbstractEvent
{
    protected $type = self::END_EVENT;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->linkCollection = new OneToNoneLinkConnection($this);
    }

    public function fire()
    {
        error_log("Workflow complete: {$this->getName()}");
    }

    public function connect(Link $link)
    {
        if ($link->getFrom() instanceof EventInterface) {
            throw new InvalidLinkException("End event cannot be linked to other events");
        }

        $this->linkCollection->addLink($link);
    }
}