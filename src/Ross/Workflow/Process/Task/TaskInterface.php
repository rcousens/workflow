<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:31 PM
 */

namespace Ross\Workflow\Process\Task;

use Ross\Workflow\Process\ProcessInterface;

interface TaskInterface extends ProcessInterface
{
    public function execute();
}