<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SingleList extends Component
{
    public $extra_classes = '';
    public $block = []; 
    public $x_data = '';

    public function mount()
    {
        $this->x_data = '{';
        foreach($this->block as $list) {
            foreach($list['items'] as $item) {
                if(isset($item['x-data'])) {
                   $this->x_data .= $item['x-data'].',';
                }
            }
        }
        $this->x_data .= '}';
    }

    public function render()
    {
        return view('walletapp::single-list');
    }
}
