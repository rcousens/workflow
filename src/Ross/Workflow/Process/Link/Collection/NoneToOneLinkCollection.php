<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 10:01 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;

class NoneToOneLinkCollection extends AbstractLinkCollection
{
   public function addLink(Link $link)
    {
        if ($link->getFrom() === $this->owner) {
            $this->outgoing[0] = $link;
        }
    }
}