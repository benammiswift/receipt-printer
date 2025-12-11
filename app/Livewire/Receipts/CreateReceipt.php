<?php

namespace App\Livewire\Receipts;

use App\Services\CreateReceiptService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateReceipt extends Component
{
    public bool $open = false;

    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string')]
    public string $description = '';

    #[On('open-create-receipt')]
    public function open(): void
    {
        $this->resetValidation();
        $this->open = true;
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function create(): mixed
    {
        $this->validate();

        // Use the service to create the receipt
        (new CreateReceiptService(
            title: $this->title,
            description: $this->description,
        ))();

        // Reset form and close flyout
        $this->reset(['title', 'description']);
        $this->open = false;

        // Redirect back to dashboard so the table updates
        return $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.receipts.create-receipt');
    }
}
