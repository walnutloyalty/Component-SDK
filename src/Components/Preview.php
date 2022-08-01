<?php

namespace Walletapp\Components\Components;

use Livewire\Component;

class Preview extends Component
{

    public $listeners = [
        'componentUpdate' => 'componentUpdate'
    ];

    public function componentUpdate($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function render()
    {
        return view('walletapp::preview');
    }
}
