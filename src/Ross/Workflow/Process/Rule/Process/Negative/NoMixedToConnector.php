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

class NoMixedToConnector
{
    public function rule(ProcessInterface $process, Link $link)
    {

        if ($process instanceof ConnectorInterface && $link->getFrom() === $process && $link->getTo() instanceof TaskInterface) {
            foreach ($process->getLinkCollection()->getOutgoing() as $outgoingLink) {
                $this->validateTask($outgoingLink->getTo());
            }
        } elseif ($process instanceof ConnectorInterface && $link->getFrom() === $process && $link->getTo() instanceof EventInterface) {
            foreach ($process->getLinkCollection()->getOutgoing() as $outgoingLink) {
                $this->validateEvent($outgoingLink->getTo());
            }
        }
//        if ($process instanceof ConnectorInterface) {
//            $incoming = $process->getLinkCollection()->getIncoming();
//
//            $iterator = new \ArrayIterator($incoming);
//
//            $type = null;
//            while ($type === null && $iterator->valid()) {
//                $current = $iterator->current()->getFrom();
//
//                if ($current instanceof TaskInterface || $current instanceof EventInterface) {
//                    $type = $current;
//                }
//                $iterator->next();
//            }
//
//            while ($iterator->valid()) {
//                if ($type instanceof TaskInterface) {
//                    $this->validateTask($iterator->current()->getFrom());
//                } elseif ($type instanceof EventInterface) {
//                    $this->validateEvent($iterator->current()->getFrom());
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
