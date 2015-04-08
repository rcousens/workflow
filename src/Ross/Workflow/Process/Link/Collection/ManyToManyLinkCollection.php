<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:19 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;

class ManyToManyLinkCollection extends AbstractLinkCollection
{
    public function addLink(Link $link)
    {
        if ($link->getTo() === $this->owner && ! $this->hasIncoming($link)) {
            $this->incoming[] = $link;
        } elseif ($link->getFrom() === $this->owner && ! $this->hasOutgoing($link)) {
            $this->outgoing[] = $link;
        }
    }

}