<?php

namespace Walletapp\Components;

use Livewire\Component;

class Notification extends Component
{
    public ?string $description;
    public string $notification_type = 'success';

    public function render()
    {
        return view('walletapp::notification');
    }
}
