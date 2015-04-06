<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:00 PM
 */

namespace Ross\Workflow\Process\Event;


use Ross\Workflow\Process\AbstractProcess;
use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\ProcessInterface;

abstract class AbstractEvent extends AbstractProcess implements EventInterface, ProcessInterface
{
    const START_EVENT = 0;
    const END_EVENT = 1;
    const GENERIC_EVENT = 2;

    protected $type;

    public function getType()
    {
        return $this->type;
    }

    public function trigger()
    {
        error_log("Event {$this->name} triggered");
    }
}