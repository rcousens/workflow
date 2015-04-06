<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:10 PM
 */

namespace Ross\Workflow\Process\Connector;


use Ross\Workflow\Process\Connector\Link\OneToOneLink;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class ControlConnector extends AbstractConnector implements ConnectorInterface
{
    public function __construct(OneToOneLink $link, ProcessInterface $processFrom, ProcessInterface $processTo)
    {
        $this->validate($processFrom, $processTo);

        $this->link = $link;

        $this->link->from($processFrom);
        $this->link->to($processTo);
    }

    public function trigger(ProcessInterface $from)
    {
        if ($this->link->getFrom() !== $from) {
               throw new \Exception();
        }

        return $this->link->getTo();
    }

    private function validate($processFrom, $processTo)
    {
        if (! ($processFrom instanceof EventInterface || $processFrom instanceof TaskInterface)) {
            throw new \Exception();
        }

        if (! ($processTo instanceof EventInterface || $processTo instanceof TaskInterface)) {
            throw new \Exception();
        }

        if ($processFrom instanceof EventInterface && ! ($processTo instanceof TaskInterface))
        {
            throw new \Exception();
        }

        if ($processTo instanceof EventInterface && ! ($processFrom instanceof TaskInterface)) {
            throw new \Exception();
        }
    }
}