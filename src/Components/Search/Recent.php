<?php

namespace Walletapp\Components\Components\Search;

use Illuminate\Support\Facades\Http;
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
