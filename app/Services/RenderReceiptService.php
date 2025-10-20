<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Receipt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RenderReceiptService
{
    private ?string $html;
    public ?string $absolutePath;
    public function __construct(
        public Receipt $receipt,
    ) {
        //
    }

    public function __invoke(): self
    {
        return $this->renderView()
            ->runWKHtmlToImage();
    }

    public function renderView(): self
    {
        $this->html = view('receipts.receipt', [
            'receipt' => $this->receipt,
        ])->render();
        return $this;
    }

    public function runWKHtmlToImage(): self
    {
        $tmpPath = 'tmp/' . Str::uuid() . '.html';
        Storage::disk('local')->put($tmpPath, $this->html);

        $tmpAbsolutePath = Storage::disk('local')->path($tmpPath);
        $outputAbsolutePath = public_path($this->receipt->filename);

        $this->absolutePath = $outputAbsolutePath;

        Storage::disk('public')->makeDirectory('receipts');

        $command = sprintf(
            'wkhtmltoimage --width 450 --quality 100 %s %s 2>&1',
            escapeshellarg($tmpAbsolutePath),
            escapeshellarg($outputAbsolutePath)
        );

        shell_exec($command);

        return $this;
    }
}
