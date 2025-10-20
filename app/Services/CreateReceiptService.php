<?php

namespace App\Services;

use App\Models\Receipt;
use Illuminate\Support\Str;

class CreateReceiptService
{
    public ?string $filename = null;
    public function __construct(
        public string $title,
        public string $description,
    ) {

    }

    public function __invoke(): Receipt
    {
        return $this->generateFilename()
            ->makeModel();
    }

    public function generateFilename(): self
    {
        $this->filename = 'receipts/' . Str::uuid() . '.png';
        return $this;
    }

    public function makeModel(): Receipt
    {
        return Receipt::create([
            'title' => $this->title,
            'description' => $this->description,
            'filename' => $this->filename,
        ]);
    }
}
