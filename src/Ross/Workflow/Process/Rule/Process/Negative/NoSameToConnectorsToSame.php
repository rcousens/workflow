<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 8/04/15
 * Time: 10:57 PM
 */

namespace Ross\Workflow\Process\Rule\Process\Negative;


use Ross\Workflow\Process\Connector\ConnectorInterface;
use Ross\Workflow\Process\Link\Link;
use Ross\Workflow\Process\ProcessInterface;

class NoSameToConnectorsToSame
{
    public function rule(ProcessInterface $process, Link $link)
    {
        if ($process instanceof ConnectorInterface) {
            $outgoing = $process->getLinkCollection()->getOutgoing();
            $incoming = $process->getLinkCollection()->getIncoming();

            foreach ($outgoing as $o) {
                if ($o->getTo)
            }
        }
    }
}