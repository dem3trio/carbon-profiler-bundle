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

interface SaveHandlerInterface
{
    public function save(Carbon $date);

    public function get();

    public function reset();
}
