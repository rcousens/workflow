<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:22 PM
 */

namespace Ross\Workflow\Process\Connector;

use Ross\Workflow\Process\Link\Collection\OneToManyLinkCollection;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class XorSplitConnector extends AbstractConnector
{
    public function __construct($name)
    {
        $this->name = $name;
        $this->linkCollection = new OneToManyLinkCollection($this);
    }

    public function connect(Link $link)
    {
        $this->linkCollection->addLink($link);
    }

    public function activate(ProcessInterface $fromProcess)
    {
        $this->trigger($fromProcess);
        if ($this->hasMetCondition()) {
            return $this->linkCollection->getOutgoing();
        }

        return $this;
    }

    public function hasMetCondition()
    {
        error_log("Connector " . get_class($this) . " has met condition");
        return true;
    }

}