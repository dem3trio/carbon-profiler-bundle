<?php

/*
 * This file is part of the CarbonProfilerBundle
 *
 * (c) Daniel Gonzalez <dgzaballos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dem3trio\Bundle\CarbonProfilerBundle\Tests;

use Carbon\Carbon;
use Dem3trio\Bundle\CarbonProfilerBundle\SaveHandler\SaveHandlerInterface;
use Dem3trio\Bundle\CarbonProfilerBundle\TimeMachine;
use PHPUnit\Framework\TestCase;

class TimeMachineTest extends TestCase implements SaveHandlerInterface
{
    /**
     * @var null|Carbon
     */
    protected $when;

    public function test_travel_and_back()
    {
        $machine = new TimeMachine($this);

        $now = new Carbon();
        $tomorrow = new Carbon('tomorrow');

        $machine->travelTo($tomorrow);
        $tomorrowNow = new Carbon();
        $this->assertSame($tomorrow->format('Y-m-d'), $tomorrowNow->format('Y-m-d'));

        $machine->backToNow();
        $newNow = new Carbon();
        $this->assertSame($now->format('Y-m-d'), $newNow->format('Y-m-d'));
    }

    public function test_initializing()
    {
        $machine = new TimeMachine($this);

        $this->assertNull($machine->getDate(), 'Date must be null when initializing.');
    }

    public function test_persistence()
    {
        $machine = new TimeMachine($this);

        $now = new Carbon();
        $strNow = $now->format('Y-m-d H:i:s');

        $machine->travelTo($now);

        $this->assertTrue($machine->timeIsSet());
        $this->assertSame($strNow, $machine->getDate()->format('Y-m-d H:i:s'));

        $machine->backToNow();

        $this->assertFalse($machine->timeIsSet());
        $this->assertNull($machine->getDate());
    }

    /**
     * Save Handler interface method for testing.
     *
     * @param Carbon $date
     */
    public function save(Carbon $date)
    {
        $this->when = $date;
    }

    /**
     * Save Handler interface method for testing.
     */
    public function get()
    {
        return $this->when;
    }

    /**
     * Save Handler interface method for testing.
     */
    public function reset()
    {
        $this->when = null;
    }
}
