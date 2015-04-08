<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 8/04/15
 * Time: 10:47 PM
 */

namespace Ross\Workflow\Process\Rule\Process\Negative;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Task\TaskInterface;

class NoTaskToTask
{
    public function rule(ProcessInterface $process, Link $link)
    {
        if ($process instanceof TaskInterface && $link->getFrom() === $process && $link->getTo() instanceof TaskInterface) {
            throw new \RuntimeException("Tasks cannot be linked to each other");
        }
    }

}