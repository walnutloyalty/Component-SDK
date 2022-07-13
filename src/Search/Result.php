<?php

namespace App\Http\Livewire\Components\Search;

use Livewire\Component;

class Result extends Component
{
  
    public $products = [], $coupons = [];

    public $listeners = [
        'results' => 'set'
    ];

    public function set($data)
    {
        $this->products = $data['products'];
        $this->coupons = $data['coupons'];
        $this->dispatchBrowserEvent('closeloader');
    }

    public function render()
    {
        return view('walletapp::search.result');
    }
}
