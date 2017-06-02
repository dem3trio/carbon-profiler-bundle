<?php

namespace Dem3trio\CarbonProfilerBundle\Listener;


use Dem3trio\CarbonProfilerBundle\TimeMachine;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    protected $timeMachine;

    public function __construct(TimeMachine $timeMachine)
    {
        $this->timeMachine = $timeMachine;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        if($this->timeMachine->timeIsSet()) {
            $date = $this->timeMachine->getDate();
            $this->timeMachine->travelTo($date);
        }
    }
}