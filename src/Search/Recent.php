<?php

namespace App\Http\Livewire\Components\Search;

use Livewire\Component;

class Recent extends Component
{
    public $list = [];

    public $listeners = [
        'recent' => 'recent'
    ];

    public function recent($item)
    {
        if (! in_array($item, $this->list)) {
            $this->list[] = $item;
        }
    }

    public function render()
    {
        return view('walletapp::search.recent');
    }
}
