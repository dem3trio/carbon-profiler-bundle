<?php

namespace Dem3trio\CarbonProfilerBundle\SaveHandler;


use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class FileSaveHandler
 */
class FileSaveHandler implements SaveHandlerInterface
{
    /** ToDo: make this through parameters */
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
        if(file_exists(self::FILE_NAME)) {
            return Carbon::createFromTimestamp(file_get_contents(self::FILE_NAME));
        }

        return null;
    }

    public function reset()
    {
        if(file_exists(self::FILE_NAME)) {
            unlink(self::FILE_NAME);
        }
    }

}