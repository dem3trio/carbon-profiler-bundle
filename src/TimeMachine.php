<?php

/*
 * This file is part of the CarbonProfilerBundle
 *
 * (c) Daniel Gonzalez <dgzaballos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dem3trio\Bundle\CarbonProfilerBundle;

use Carbon\Carbon;
use Dem3trio\Bundle\CarbonProfilerBundle\SaveHandler\SaveHandlerInterface;

/**
 * Class TimeMachine
 */
class TimeMachine
{
    /**
     * @var SaveHandlerInterface
     */
    protected $saveHandler;

    /**
     * TimeMachine constructor.
     *
     * @param SaveHandlerInterface $saveHandler
     */
    public function __construct(SaveHandlerInterface $saveHandler)
    {
        $this->saveHandler = $saveHandler;
    }

    public function timeIsSet()
    {
        return null !== $this->saveHandler->get();
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
