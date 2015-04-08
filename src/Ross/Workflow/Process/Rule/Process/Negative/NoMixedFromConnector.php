<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 8/04/15
 * Time: 10:57 PM
 */

namespace Ross\Workflow\Process\Rule\Process\Negative;


use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class NoMixedFromConnector
{
    public function rule(ProcessInterface $process, Link $link)
    {
        if ($process instanceof ConnectorInterface && $link->getTo() === $process && $link->getFrom() instanceof TaskInterface) {
            foreach ($process->getLinkCollection()->getIncoming() as $incomingLink) {
                $this->validateTask($incomingLink->getFrom());
            }
        } elseif ($process instanceof ConnectorInterface && $link->getTo() === $process && $link->getFrom() instanceof EventInterface) {
            foreach ($process->getLinkCollection()->getIncoming() as $incomingLink) {
                $this->validateEvent($incomingLink->getFrom());
            }
        }
//            $outgoing = $process->getLinkCollection()->getOutgoing();
//
//            $iterator = new \ArrayIterator($outgoing);
//
//            $type = null;
//            while ($type === null && $iterator->valid()) {
//                $current = $iterator->current()->getTo();
//
//                if ($current instanceof TaskInterface || $current instanceof EventInterface) {
//                    $type = $current;
//                }
//                $iterator->next();
//            }
//
//            while ($iterator->valid()) {
//                if ($type instanceof TaskInterface) {
//                    $this->validateTask($iterator->current()->getTo());
//                } elseif ($type instanceof EventInterface) {
//                    $this->validateEvent($iterator->current()->getTo());
//                }
//            }
//        }

    }

    public function validateTask(ProcessInterface $process) {
        if (! $process instanceof TaskInterface) {
            throw new \RuntimeException('Not a task');
        }
    }


    public function validateEvent(ProcessInterface $process) {
        if (! $process instanceof EventInterface) {
            throw new \RuntimeException('Not an event');
        }
    }

}
