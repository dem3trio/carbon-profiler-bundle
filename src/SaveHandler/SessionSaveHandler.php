<?php

/*
 * This file is part of the CarbonProfilerBundle
 *
 * (c) Daniel Gonzalez <dgzaballos@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dem3trio\Bundle\CarbonProfilerBundle\SaveHandler;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SessionSaveHandler.
 */
class SessionSaveHandler implements SaveHandlerInterface
{
    const SESSION_KEY = '_dem3trio.time_machine';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * SessionSaveHandler constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @param Carbon $date
     */
    public function save(Carbon $date)
    {
        $this->session->set(self::SESSION_KEY, $date->timestamp);
    }

    /**
     * @return null|Carbon
     */
    public function get()
    {
        if ($this->session->has('_dem3trio.time_machine')) {
            return Carbon::createFromTimestamp($this->session->get(self::SESSION_KEY));
        }

        return null;
    }

    public function reset()
    {
        if ($this->session->has('_dem3trio.time_machine')) {
            $this->session->remove(self::SESSION_KEY);
        }
    }
}
