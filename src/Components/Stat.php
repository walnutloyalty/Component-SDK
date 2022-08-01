<?php

namespace Walletapp\Components\Components;

use Livewire\Component;

class Stat extends Component
{
    public $tabs = [];
    public $tooltip;
    public $comparison = false;
    public $percentage = false;
    
    public function render()
    {
        return view('walletapp::stat');
    }
}
