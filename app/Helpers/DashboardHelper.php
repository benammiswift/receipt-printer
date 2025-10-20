<?php

namespace App\Helpers;

use App\Enums\Timeframe;
use App\Models\Receipt;
use GuzzleHttp\Psr7\Request;

class DashboardHelper
{
    public static function getDashboardCount(
        Timeframe $timeframe
    ): int
    {
        return Receipt::query()
            ->where('created_at', '>=', $timeframe->getSince())
            ->count();
    }
}
