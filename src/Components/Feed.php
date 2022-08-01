<?php

namespace Walletapp\Components\Components;

use Livewire\Component;

class Feed extends Component
{
    public $items = [];
    
    public $title;
    
    public function render()
    {
        return view('walletapp::feed');
    }
}
