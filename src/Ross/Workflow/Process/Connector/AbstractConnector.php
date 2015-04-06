<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:10 PM
 */

namespace Ross\Workflow\Process\Connector;

use Ross\Workflow\Process\AbstractProcess;
use Ross\Workflow\Process\ProcessInterface;

abstract class AbstractConnector extends AbstractProcess implements ConnectorInterface
{
    public function trigger(ProcessInterface $fromProcess)
    {
        error_log("Connector {$this->getName()} triggered by {$fromProcess->getName()}");
    }


}