<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait TourDateHelper
{
    protected function isBetween(Carbon $date, Carbon $start, Carbon $end): bool
    {
        return $date->betweenIncluded($start, $end);
    }

    public function isBetweenMayAndSeptember(Carbon $date): bool
    {
        $currentYear = now()->year;

        $startDate = Carbon::createFromDate($currentYear, 5, 1);
        $endDate = Carbon::createFromDate($currentYear, 9, 30);

        return $this->isBetween($date, $startDate, $endDate);
    }

    public function isBetweenOctoberAndDecember(Carbon $date): bool
    {
        $currentYear = now()->year;

        $startDate = Carbon::createFromDate($currentYear, 10, 1);
        $endDate = Carbon::createFromDate($currentYear, 12, 22);

        return $this->isBetween($date, $startDate, $endDate);
    }

    public function isInPeakPeriods(Carbon $date): bool
    {
        $currentYear = now()->year;

        $period1Start = Carbon::createFromDate($currentYear, 12, 23);
        $period1End = Carbon::createFromDate($currentYear + 1, 1, 7);

        $period2Start = Carbon::createFromDate($currentYear, 4, 14);
        $period2End = Carbon::createFromDate($currentYear, 4, 23);

        return $this->isBetween($date, $period1Start, $period1End)
            || $this->isBetween($date, $period2Start, $period2End);
    }
}
