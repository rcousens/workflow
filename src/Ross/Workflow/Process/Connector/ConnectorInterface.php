<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:11 PM
 */

namespace Ross\Workflow\Process\Connector;

use Ross\Workflow\Process\ProcessInterface;

interface ConnectorInterface
{
    public function activate(ProcessInterface $process);

    public function trigger(ProcessInterface $fromProcess);
}