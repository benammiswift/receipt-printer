<?php

namespace App\Console\Commands;

use App\Services\CreateReceiptService;
use App\Services\RenderReceiptService;
use Illuminate\Console\Command;

class CreateReceipt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receipt:create {--seed : Seed the receipt with test data}';

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
        if ($this->option('seed')) {
            $title = 'Test Receipt';
            $description = 'This is a test receipt generated with seeded data, this description is nice and big so itll definitely wrap around';
        } else {
            $title = $this->ask('What is the receipt title?');
            $description = $this->ask('What is the receipt description?');
        }

        $receipt = (new CreateReceiptService(
            title: $title,
            description: $description,
        ))();

        (new RenderReceiptService($receipt))();

        $this->info('Receipt created successfully!');
    }
}
