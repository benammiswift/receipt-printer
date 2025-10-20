<?php

return [
    'cli_command' => env('CLI_COMMAND', 'lp -d TM_T70 \ -o fit-to-page \ -o orientation-requested=3 \ -o media=Custom.80x200mm \ -o position=center \ -o align=center \ %s'),
    'enabled' => env('RECEIPTS_ENABLED', false),
    'receipt_view' => 'receipts.receipt'
];
