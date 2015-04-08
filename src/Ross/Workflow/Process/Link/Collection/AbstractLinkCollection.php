<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:30 PM
 */

namespace Ross\Workflow\Process\Link\Collection;


use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

abstract class AbstractLinkCollection implements LinkCollectionInterface
{
    protected $incoming = [];
    protected $outgoing = [];

    public function __construct(ProcessInterface $owner, $links = [])
    {
        $this->owner = $owner;

        foreach ($links as $link) {
            if ($link instanceof Link) {
                $this->addLink($link);
            }
        }
    }
    public function getIncoming()
    {
        return $this->incoming;
    }

    public function getOutgoing()
    {
        return $this->outgoing;
    }

    public function hasIncoming(Link $link)
    {
       return in_array($link, $this->incoming);
    }

    public function hasOutgoing(Link $link)
    {
        return in_array($link, $this->outgoing);
    }
}