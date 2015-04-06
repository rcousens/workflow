<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:19 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class ManyToManyLinkCollection extends AbstractLinkCollection
{
    public function __construct(ProcessInterface $owner, $links = [])
    {
        $this->owner = $owner;

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
        } elseif ($link->getFrom() === $this->owner && ! in_array($link, $this->outgoing)) {
            $this->outgoing[] = $link;
        }
    }

}