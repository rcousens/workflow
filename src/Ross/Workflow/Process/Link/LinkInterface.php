<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 5:48 PM
 */

namespace Ross\Workflow\Process\Link;

use Ross\Workflow\Process\ProcessInterface;

interface LinkInterface
{
    public function __construct(ProcessInterface $from, ProcessInterface $to);

    public function getTo();

    public function getFrom();
}