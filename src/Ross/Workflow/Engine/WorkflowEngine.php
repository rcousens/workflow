<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 3:27 PM
 */

namespace Ross\Workflow\Engine;


use Ross\Workflow\Process\Connector\XorMergeConnector;
use Ross\Workflow\Process\Connector\XorSplitConnector;
use Ross\Workflow\Process\Event\Generic\GenericEvent;
use Ross\Workflow\Process\Event\Start\StartEvent;
use Ross\Workflow\Process\Task\Generic\GenericTask;
use Ross\Workflow\Sequence\Sequence;

class WorkflowEngine
{
    public function __construct()
    {
        $sequence = new Sequence();

        $startEvent = new StartEvent("Redpen Submitted");
        $approvalTask = new GenericTask("Approval Task");
        $approvalEvent = new GenericEvent("Approval Event");
        $draftTask = new GenericTask("Draft Task");
        $draftEvent = new GenericEvent("Draft Submitted");
        $approvalDraftTaskPrecursor = new XorMergeConnector("Draft Approval Precursor");
        $approvalDraftTask = new GenericTask("Draft Approval");
        $approvalDraftTaskOutcome = new XorSplitConnector("Draft Approval Outcome");
        $draftApprovedEvent = new GenericEvent("Draft Approved Event");
        $draftDeclinedEvent = new GenericEvent("Draft Declined Event");

        $sequence->connectProcesses($startEvent, $approvalTask);
        $sequence->connectProcesses($approvalTask, $approvalEvent);
        $sequence->connectProcesses($approvalEvent, $draftTask);
        $sequence->connectProcesses($draftTask, $draftEvent);
        $sequence->connectProcesses($draftEvent, $approvalDraftTaskPrecursor);
        $sequence->connectProcesses($approvalDraftTaskPrecursor, $approvalDraftTask);
        $sequence->connectProcesses($approvalDraftTask, $approvalDraftTaskOutcome);
        $sequence->connectProcesses($approvalDraftTaskOutcome, $draftApprovedEvent);
        $sequence->connectProcesses($approvalDraftTaskOutcome, $draftDeclinedEvent);
        $sequence->connectProcesses($draftDeclinedEvent, $approvalDraftTaskPrecursor);

        $sequence->start("Redpen Submitted");
        do  {
            $sequence->proceed();
        } while($sequence->getCurrentProcess() !== null);
        
    }
}