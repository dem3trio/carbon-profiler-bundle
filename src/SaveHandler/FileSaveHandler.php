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

/**
 * Class FileSaveHandler.
 */
class FileSaveHandler implements SaveHandlerInterface
{
    const FILE_NAME = '/tmp/_dem3trio_time_machine.lock';

    /**
     * @param Carbon $date
     */
    public function save(Carbon $date)
    {
        file_put_contents(self::FILE_NAME, $date->timestamp);
    }

    /**
     * @return null|Carbon
     */
    public function get()
    {
        if (file_exists(self::FILE_NAME)) {
            return Carbon::createFromTimestamp(file_get_contents(self::FILE_NAME));
        }

        return null;
    }

    public function reset()
    {
        if (file_exists(self::FILE_NAME)) {
            unlink(self::FILE_NAME);
        }
    }
}
