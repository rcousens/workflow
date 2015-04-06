<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 7:46 PM
 */

namespace Ross\Workflow\Process\Task;


use Ross\Workflow\Process\AbstractProcess;
use Ross\Workflow\Process\ProcessInterface;

abstract class AbstractTask extends AbstractProcess implements TaskInterface, ProcessInterface
{
    public function trigger()
    {
        error_log("Task {$this->name} triggered");
    }

    public function execute()
    {
        error_log("Executed task {$this->name}");

        return $this->linkCollection->getOutgoing()->getTo();
    }

}