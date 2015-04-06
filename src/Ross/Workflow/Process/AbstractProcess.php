<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 8:55 PM
 */

namespace Ross\Workflow\Process;

abstract class AbstractProcess implements ProcessInterface
{
    protected $linkCollection;
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}