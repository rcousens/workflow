<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 8/04/15
 * Time: 10:46 PM
 */

namespace Ross\Workflow\Process\Rule\Process;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;
use Ross\Workflow\Process\Rule\Process\Negative\NoEventToEvent;
use Ross\Workflow\Process\Rule\Process\Negative\NoMixedFromConnector;
use Ross\Workflow\Process\Rule\Process\Negative\NoMixedToConnector;
use Ross\Workflow\Process\Rule\Process\Negative\NoTaskToTask;

class ProcessRuleEngine
{

    protected $rules = [];

    public function __construct()
    {
        $this->rules[] = new NoEventToEvent();
        $this->rules[] = new NoMixedFromConnector();
        $this->rules[] = new NoMixedToConnector();
        $this->rules[] = new NoTaskToTask();
    }

    public function validate(ProcessInterface $process, Link $link) {
        foreach ($this->rules as $rule) {
            $rule->rule($process, $link);
        }
    }
}