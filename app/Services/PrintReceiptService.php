<?php

namespace App\Services;

class PrintReceiptService
{
    public function __construct(
        public string $filename,
    ) {
        //
    }

    public function __invoke(): void
    {
        if (!config('receipts.enabled')) {
            return;
        }

        $commandFormatter = config('receipts.cli_command');

        $command = sprintf($commandFormatter, $this->filename);

        shell_exec($command);
    }
}
