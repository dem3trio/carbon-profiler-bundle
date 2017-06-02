<?php

namespace Dem3trio\Bundle\CarbonProfilerBundle;


use Carbon\Carbon;
use Dem3trio\Bundle\CarbonProfilerBundle\SaveHandler\SaveHandlerInterface;

class TimeMachine
{
    /**
     * @var SaveHandlerInterface
     */
    protected $saveHandler;

    /**
     * TimeMachine constructor.
     * @param SaveHandlerInterface $saveHandler
     */
    function __construct(SaveHandlerInterface $saveHandler)
    {
        $this->saveHandler = $saveHandler;
    }

    public function timeIsSet()
    {
        return (null !== $this->saveHandler->get());
    }

    public function getDate()
    {
        return $this->saveHandler->get();
    }

    public function travelTo(Carbon $date)
    {
        Carbon::setTestNow($date);
        $this->saveHandler->save($date);
    }

    public function backToNow()
    {
        Carbon::setTestNow();
        $this->saveHandler->reset();
    }
}