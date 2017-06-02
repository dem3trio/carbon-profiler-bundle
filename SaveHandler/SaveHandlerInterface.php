<?php

namespace Dem3trio\CarbonProfilerBundle\SaveHandler;


use Carbon\Carbon;

interface SaveHandlerInterface
{
    public function save(Carbon $date);

    public function get();

    public function reset();
}