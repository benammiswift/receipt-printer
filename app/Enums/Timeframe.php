<?php

declare(strict_types=1);

namespace App\Enums;

use Carbon\Carbon;

enum Timeframe: int
{
    case THIS_WEEK = 1;
    case THIS_MONTH = 2;
    case THIS_YEAR = 3;
    case ALL_TIME = 4;

    public function getSince(): Carbon
    {
        return match ($this) {
            self::THIS_WEEK => now()->startOfWeek(),
            self::THIS_MONTH => now()->startOfMonth(),
            self::THIS_YEAR => now()->startOfYear(),
            self::ALL_TIME => now()->subYears(100),
        };
    }
}
