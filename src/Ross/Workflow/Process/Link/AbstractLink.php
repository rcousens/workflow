<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 5:08 PM
 */

namespace Ross\Workflow\Process\Link;

use Ross\Workflow\Exception\InvalidLinkException;
use Ross\Workflow\Process\ProcessInterface;

abstract class AbstractLink implements LinkInterface
{
    protected $from;
    protected $to;

    public function __construct(ProcessInterface $from, ProcessInterface $to)
    {
        if ($from === $to) {
            throw new InvalidLinkException;
        }

        $this->from = $from;
        $this->to = $to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }
}