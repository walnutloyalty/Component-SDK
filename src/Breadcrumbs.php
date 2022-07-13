<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Exception;

class Breadcrumbs extends Component
{
    public $title = [];

    public $items = [

    ];

    public $listeners = [
        'appendBreadCrumb' => 'append',
        'prependBreadCrumb' => 'prepend'
    ];

    public function append($item)
    {
        $item['array_key'] = count($this->items);
        $this->items[] = $item;
    }

    public function executeBreadcrumb($key)
    {
        $item = $this->items[$key];
        if(isset($item['event'])) {
            $this->dispatchBrowserEvent($item['event']);
        }
        unset($this->items[$key]);
    }

    public function prepend()
    {

    }

    public function mount()
    {
        if (! $this->title) {
            throw new Exception('No title set in breadcrumbs');
        }
    }
    public function render()
    {
        return view('walletapp::breadcrumbs');
    }
}
