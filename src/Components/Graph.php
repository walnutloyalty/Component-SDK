<?php

namespace Walletapp\Components\Components;

use Livewire\Component;

class Graph extends Component
{
    public $tabs = [];
    public $data = [];
    public $title;
    public $labels;
    public $tooltip;

    public $type = 'area';

    public function render()
    {
        return view('walletapp::graph');
    }
}
