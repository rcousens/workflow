<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:20 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class OneToOneLinkCollection extends AbstractLinkCollection
{
    public function __construct(ProcessInterface $owner, Link $link = null)
    {
        $this->owner = $owner;
        $this->outgoing[0] = null;
        $this->incoming[0] = null;

        if (null !== $link) {
            $this->addLink($link);
        }
    }

    public function addLink(Link $link)
    {
        if ($link->getFrom() === $this->owner && null === $this->outgoing[0]) {
            $this->outgoing[0] = $link;
        } elseif ($link->getTo() === $this->owner && null === $this->incoming[0]) {
            $this->incoming[0] = $link;
        }
    }

    public function getOutgoing()
    {
        return $this->outgoing[0];
    }

    public function getIncoming()
    {
        return $this->incoming[0];
    }
}