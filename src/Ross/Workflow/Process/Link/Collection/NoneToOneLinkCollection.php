<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 10:01 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class NoneToOneLinkCollection extends AbstractLinkCollection
{
    public function __construct(ProcessInterface $owner, $links = [])
    {
        $this->owner = $owner;
        $this->outgoing[0] = null;

        foreach ($links as $link) {
            if ($link instanceof Link) {
                $this->addLink($link);
            }
        }
    }

    public function addLink(Link $link)
    {
        error_log("Add link called for {$this->owner->getName()}");
        if ($link->getFrom() === $this->owner && null === $this->outgoing[0]) {
            error_log("Setting outgoing link for {$this->owner->getName()}");
            $this->outgoing[0] = $link;
        }
    }

    public function getOutgoing()
    {
        return $this->outgoing[0];
    }


}