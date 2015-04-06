<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 6:22 PM
 */

namespace Ross\Workflow\Process\Connector;


use Ross\Workflow\Process\Link\Collection\ManyToOneLinkCollection;
use Ross\Workflow\Process\ProcessInterface;

class OrMergeConnector extends AbstractConnector implements ConnectorInterface, ProcessInterface
{
    public function __construct($name)
    {
        parent::__construct($name);
        $this->link = $link;
    }

    public function traverse($from)
    {
        if (! in_array($from, $this->link->getFrom())) {
            throw new \Exception();
        }

        return $this->link->getTo();
    }
}