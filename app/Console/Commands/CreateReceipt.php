<?php

namespace App\Console\Commands;

use App\Services\CreateReceiptService;
use Illuminate\Console\Command;

class CreateReceipt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receipt:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new receipt with title and description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $title = $this->ask('What is the receipt title?');
        $description = $this->ask('What is the receipt description?');

        (new CreateReceiptService(
            title: $title,
            description: $description,
        ))();

        $this->info('Receipt created successfully!');
    }
}
