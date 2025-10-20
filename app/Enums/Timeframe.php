<?php

declare(strict_types=1);

namespace App\Enums;

use Carbon\Carbon;

enum Timeframe: int
{
    case LAST_WEEK = 1;
    case LAST_MONTH = 2;
    case LAST_YEAR = 3;
    case ALL_TIME = 4;

    public function getSince(): Carbon
    {
        return match ($this) {
            self::LAST_WEEK => now()->startOfWeek(),
            self::LAST_MONTH => now()->startOfMonth(),
            self::LAST_YEAR => now()->startOfYear(),
            self::ALL_TIME => now()->subYears(100),
        };
    }
}
