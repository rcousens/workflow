<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:20 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;

class OneToOneLinkCollection extends AbstractLinkCollection
{
    public function addLink(Link $link)
    {
        if ($link->getFrom() === $this->owner) {
            $this->outgoing[0] = $link;
        } elseif ($link->getTo() === $this->owner) {
            $this->incoming[0] = $link;
        }
    }
}