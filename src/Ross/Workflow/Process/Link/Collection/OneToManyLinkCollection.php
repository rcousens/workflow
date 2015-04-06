<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:18 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class OneToManyLinkCollection extends AbstractLinkCollection
{
    public function __construct(ProcessInterface $owner, $links = [])
    {
        $this->owner = $owner;
        $this->incoming[0] = null;

        foreach ($links as $link) {
            if ($link instanceof Link) {
                $this->addLink($link);
            }
        }
    }

    public function addLink(Link$link)
    {
        if ($link->getTo() === $this->owner && null === $this->incoming[0]) {
            $this->incoming[0] = $link;
        } elseif ($link->getFrom() === $this->owner && ! in_array($link, $this->outgoing)) {
            $this->outgoing[] = $link;
        }
    }

    public function getIncoming()
    {
        return $this->incoming[0];
    }
}