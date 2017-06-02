<?php

/*
 * This file is part of the CarbonProfilerBundle
 *
 * (c) Daniel Gonzalez <dgzaballos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dem3trio\Bundle\CarbonProfilerBundle\Listener;

use Dem3trio\Bundle\CarbonProfilerBundle\TimeMachine;
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

        if ($this->timeMachine->timeIsSet()) {
            $date = $this->timeMachine->getDate();
            $this->timeMachine->travelTo($date);
        }
    }
}
