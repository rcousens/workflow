<?php
/**
 * Created by IntelliJ IDEA.
 * User: ross
 * Date: 6/04/15
 * Time: 5:19 PM
 */

namespace Ross\Workflow\Process;


use Ross\Workflow\Process\Link\Link;

interface ProcessInterface
{
    public function __construct($name);

    public function connect(Link $link);

    public function getName();

    public function getLinkCollection();
}