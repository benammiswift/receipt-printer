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

    public function __invoke(): self
    {
        return $this->generateFilename()
            ->makeModel();
    }

    public function generateFilename(): self
    {
        $this->filename = sprintf(
            "/storage/private/receipts/%s.png",
            Str::uuid()->toString()
        );
        return $this;
    }

    public function makeModel(): self
    {
        Receipt::create([
            'title' => $this->title,
            'description' => $this->description,
            'filename' => $this->filename,
        ]);
        return $this;
    }
}
