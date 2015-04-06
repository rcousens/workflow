<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:16 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class ManyToOneLinkCollection extends AbstractLinkCollection
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
        if ($link->getTo() === $this->owner && ! in_array($link, $this->incoming)) {
            $this->incoming[] = $link;
        } elseif ($link->getFrom() === $this->owner && null === $this->outgoing[0]) {
            $this->outgoing[0] = $link;
        }
    }

    public function getOutgoing()
    {
        return $this->outgoing[0];
    }
}