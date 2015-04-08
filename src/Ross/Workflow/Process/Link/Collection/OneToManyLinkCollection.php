<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:18 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;

class OneToManyLinkCollection extends AbstractLinkCollection
{
    public function addLink(Link $link)
    {
        if ($link->getTo() === $this->owner) {
            $this->incoming[0] = $link;
        } elseif ($link->getFrom() === $this->owner && !$this->hasOutgoing($link)) {
            $this->outgoing[] = $link;
        }
    }
}

