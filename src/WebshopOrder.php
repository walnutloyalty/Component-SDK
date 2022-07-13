<?php

namespace Walletapp\Components;

use Livewire\Component;
use Facades\App\Http\Repositories\Brand;

class WebshopOrder extends Component
{
    public $model;
    public $brands = [];
    public $order = [];
    public $shops = [];

    public function getListeners()
    {
        return [
            $this->model => 'setCastedElement',
        ];
    }

    public function mount()
    {
        $brands = array_filter(array_map(function ($item) {
            return [
                $item->id => $item->name,
            ];
        },  Brand::get()->shops), fn($value) => ! is_null($value));
        foreach ($brands as $brand) {
            foreach ($brand as $id => $name) {
                $this->brands[$id] = $name;
            }
        }
        $this->{$this->model} = []; 
    }

    public function updatedOrder()
    {
        $this->emit('updatedCustomComponent', ['shops' => $this->shops, $this->model => $this->order]);
    }

    public function setCastedElement($data) 
    {
        foreach ($data as $value) {
            foreach ($value as $key => $item) {
                $this->order[$key] = null;
            }
        }
        $this->shops = $data['brands'];
    }

    public function render()
    {
        return view('walletapp::webshop-order');
    }
}
