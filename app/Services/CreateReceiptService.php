<?php

namespace App\Services;

use App\Models\Receipt;
use Illuminate\Support\Str;

class CreateReceiptService
{
    public ?string $filename = null;
    public ?Receipt $receipt;
    public ?string $receiptPath;
    public function __construct(
        public string $title,
        public string $description,
    ) {

    }

    public function __invoke(): self
    {
        return $this->generateFilename()
            ->makeModel()
            ->renderView()
            ->printReceipt();
    }

    public function generateFilename(): self
    {
        $this->filename = 'receipts/' . Str::uuid() . '.png';
        return $this;
    }

    public function makeModel(): self
    {
        $this->receipt = Receipt::create([
            'title' => $this->title,
            'description' => $this->description,
            'filename' => $this->filename,
        ]);
        return $this;
    }

    public function renderView(): self
    {
        $this->receiptPath = (new RenderReceiptService($this->receipt))()->absolutePath;
        return $this;
    }

    public function printReceipt(): self
    {
        (new PrintReceiptService($this->receiptPath))();
        return $this;
    }
}
