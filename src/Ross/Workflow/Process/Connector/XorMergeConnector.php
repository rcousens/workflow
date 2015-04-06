<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 7/04/15
 * Time: 1:01 AM
 */

namespace Ross\Workflow\Process\Connector;

use Ross\Workflow\Process\Link\Collection\ManyToOneLinkCollection;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class XorMergeConnector extends AbstractConnector
{
    public function __construct($name)
    {
        $this->name = $name;
        $this->linkCollection = new ManyToOneLinkCollection($this);
    }

    public function connect(Link $link)
    {
        $this->linkCollection->addLink($link);
    }

    public function activate(ProcessInterface $fromProcess)
    {
        $this->trigger($fromProcess);
        if ($this->hasMetCondition()) {
            return $this->linkCollection->getOutgoing()->getTo();
        }

        return $this;
    }

    public function hasMetCondition()
    {
        error_log("Connector " . get_class($this) . " has met condition");
        return true;
    }

}