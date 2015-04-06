<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 9:14 PM
 */

namespace Ross\Workflow\Process\Link\Collection;

use Ross\Workflow\Process\Link\Link;

interface LinkCollectionInterface
{
    public function addLink(Link $link);
    public function getIncoming();
    public function getOutgoing();
}