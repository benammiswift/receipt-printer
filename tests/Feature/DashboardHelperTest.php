<?php

use App\Enums\Timeframe;
use App\Helpers\DashboardHelper;
use App\Models\Receipt;
use Carbon\Carbon;

it('counts receipts correctly for each timeframe', function () {
    // Freeze time to a known point to make boundaries deterministic
    $now = Carbon::create(2025, 10, 20, 12, 0, 0); // 20 Oct 2025, Monday
    Carbon::setTestNow($now);

    // Helper to create a receipt at a specific datetime
    $makeReceiptAt = function (Carbon $when) {
        $r = new Receipt();
        $r->created_at = $when;
        $r->updated_at = $when;
        $r->save();
    };

    // --- LAST_WEEK (actually: since start of current week) ---
    // startOfWeek for the frozen now is 2025-10-20 00:00:00 (Monday)
    $makeReceiptAt($now->copy()->subDay()); // 2025-10-19 12:00 (Sunday) -> should NOT count
    $makeReceiptAt($now->copy()->startOfWeek()); // 2025-10-20 00:00 -> should count
    $makeReceiptAt($now->copy()); // 2025-10-20 12:00 -> should count

    expect(DashboardHelper::getDashboardCount(Timeframe::LAST_WEEK))
        ->toBe(2);


    // --- LAST_MONTH (since start of current month) ---
    // startOfMonth is 2025-10-01 00:00:00
    $makeReceiptAt(Carbon::create(2025, 9, 30, 23, 59, 59)); // Sept -> should NOT count (for month), but WILL count for year/all-time
    $makeReceiptAt(Carbon::create(2025, 10, 1, 0, 0, 0)); // Oct 1 -> should count

    expect(DashboardHelper::getDashboardCount(Timeframe::LAST_MONTH))
        ->toBe(4); // Oct 19 + Oct 20 00:00 + Oct 20 12:00 + Oct 1 = 4


    // --- LAST_YEAR (since start of current year) ---
    // startOfYear is 2025-01-01 00:00:00
    $makeReceiptAt(Carbon::create(2024, 12, 31, 23, 59, 59)); // 2024 -> should NOT count
    $makeReceiptAt(Carbon::create(2025, 1, 1, 0, 0, 0)); // 2025 -> should count

    expect(DashboardHelper::getDashboardCount(Timeframe::LAST_YEAR))
        ->toBe(6); // All receipts in 2025: Jan 1, Sep 30, Oct 1, Oct 19, Oct 20 00:00, Oct 20 12:00

    // --- ALL_TIME (since 100 years ago) ---
    // Everything we've created so far should be included except if older than 100 years
    // Add an old one beyond 100 years ago to ensure it is excluded
    $makeReceiptAt($now->copy()->subYears(101)); // should NOT count

    expect(DashboardHelper::getDashboardCount(Timeframe::ALL_TIME))
        ->toBe(7); // all receipts within the last 100 years

    // Cleanup test time
    Carbon::setTestNow();
});
