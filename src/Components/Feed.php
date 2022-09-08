<?php

namespace Walletapp\Components\Components;

use Livewire\Component;

class Feed extends Component
{
    public $items = [];
    
    public $title;
    
    public $mode;

    public function getListeners()
    {
        return [
            'setFeedData'.ucfirst($this->mode) => 'data'
        ];
    }

    public function data($data)
    {
        $this->items = $data;
    }

    public function render()
    {
        return view('walletapp::feed');
    }
}
