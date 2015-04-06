<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:30 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


abstract class AbstractLinkCollection implements LinkCollectionInterface
{
    protected $incoming = [];
    protected $outgoing = [];

    public function getIncoming()
    {
        return $this->incoming;
    }

    public function getOutgoing()
    {
        return $this->outgoing;
    }

    public function hasLink($link)
    {
        return in_array($link, array_merge($this->incoming, $this->outgoing));
    }
}