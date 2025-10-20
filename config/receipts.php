<?php

return [
    'cli_command' => env('CLI_COMMAND', 'lp -d TM_T70 -0 fit-to-page %s'),
    'enabled' => env('RECEIPTS_ENABLED', false),
];
