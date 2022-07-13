<?php

namespace App\Http\Livewire\Components;

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
