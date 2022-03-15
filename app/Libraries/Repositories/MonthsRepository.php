<?php

namespace App\Libraries\Repositories;

use Carbon\Carbon;

class MonthsRepository
{
    private $start = '2015-11';

    public function getRange()
    {
        $range = [];
        $today = Carbon::now()->startOfMonth();

        while ($today->format('Y-m') != $this->start) {
            $key = $today->format('Y-m');
            $range[$key] = $today->formatLocalized('%B %Y');

            $today->subMonth();
        }

        return $range;
    }
}