<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:27 PM
 */

namespace Ross\Workflow\Sequence;


use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Event\End\EndEvent;
use Ross\Workflow\Process\Event\EventInterface;
use Ross\Workflow\Process\Event\Start\StartEvent;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class Sequence
{
    protected $startEvents = [];
    protected $endEvents = [];
    protected $processes = [];
    protected $currentProcess = null;
    protected $previousProcess = null;

    public function start($name)
    {
        $hash = md5($name);
        if ($this->startEvents[$hash] instanceof StartEvent) {
            $this->setCurrentProcess($this->startEvents[$hash]->fire());
        }
    }

    public function connectProcesses(ProcessInterface $fromProcess, ProcessInterface $toProcess)
    {
        $link = new Link($fromProcess, $toProcess);
        $fromProcess->connect($link);
        $toProcess->connect($link);

        if ($toProcess instanceof EndEvent) {
            $this->endEvents[md5($toProcess->getName())] = $toProcess;
        }

        if ($fromProcess instanceof StartEvent) {
            $this->startEvents[md5($fromProcess->getName())] = $fromProcess;
        }
    }

    public function proceed()
    {
        if (null === $this->currentProcess) {
//            error_log("Sequence completed");
            return;
        }

        if ($this->currentProcess instanceof TaskInterface) {
            error_log("Executing task");
            $newProcess = $this->currentProcess->execute();
            $this->setCurrentProcess($newProcess);
            return;
        }

        if ($this->currentProcess instanceof EventInterface) {
            error_log("Firing event");
            $newProcess = $this->currentProcess->fire();
            $this->setCurrentProcess($newProcess);
            return;
        }
        // XOR HANDLER

        if ($this->currentProcess instanceof ConnectorInterface) {
            error_log("Activating connector");
            $this->setCurrentProcess($this->currentProcess->activate($this->previousProcess));
            return;
        }
        if (is_array($this->currentProcess)) {
            error_log("Handling array response");
            if (count($this->currentProcess) === 1) {
                $this->setCurrentProcess($this->currentProcess[0]->getTo());
                error_log("Selecting only outcome: {$this->currentProcess->getName()}");
            } elseif (count($this->currentProcess) > 1) {
                $this->setCurrentProcess($this->currentProcess[rand(0, count($this->currentProcess) - 1)]->getTo());
                error_log("Selecting random outcome: {$this->currentProcess->getName()}");
            }
            return;
        }

//        error_log("Doing nothing");
    }

    public function getCurrentProcess()
    {
        return $this->currentProcess;
    }

    private function setCurrentProcess($currentProcess)
    {
        $this->previousProcess = $this->currentProcess;
        $this->currentProcess = $currentProcess;

        if ($this->previousProcess instanceof ProcessInterface) {
            //error_log("Sequence->previousProcess = {$this->previousProcess->getName()}");
        }
        if ($this->currentProcess instanceof ProcessInterface) {
            //error_log("Sequence->currentProcess = {$this->currentProcess->getName()}");
        }

    }

}