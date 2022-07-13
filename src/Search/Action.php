<?php

namespace Walletapp\Components\Search;

use Livewire\Component;

class Action extends Component
{

    public $user = [];
    public $listeners = [
        'user' => 'user'
    ];

    public function user($data)
    {
        $this->user = $data;
    }

    public function render()
    {
        return view('walletapp::search.action');
    }
}
