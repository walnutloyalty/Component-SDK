<?php

namespace Walletapp\Components\Components;

use Facades\App\Http\Repositories\Product;
use Livewire\Component;
use Facades\App\Http\Repositories\Location;
use Facades\App\Http\Repositories\Brand;
use Facades\App\Http\Repositories\Tag;
use Illuminate\Support\Facades\Http;
use Auth;

class ModelSelect extends Component
{
    public $type;
    public $extra_classes;
    public $label;
    public $model;
    public $multiple = false;
    public $items = [];
    public $emit_to_parent = false;
    public $parent_listener;

    public function mount()
    {
        if ($this->multiple) {
            $this->{$this->model} = [];
        } else {
            $this->{$this->model} = null;
        }
        
        switch($this->type) { 
            case 'brands':
                $this->items = array_filter(array_map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                    ];
                },  Brand::get()->shops), fn($value) => ! is_null($value));
                break;
            case 'locations':
                $this->items = array_filter(array_map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->address,
                    ];
                }, Location::get()->data), fn($value) => ! is_null($value));
                break;

            case 'coupons':
                $this->items = array_filter(array_map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->title,
                    ];
                }, Product::coupons()->data), fn($value) => ! is_null($value));
                break;
            case 'storecards':
                $this->items = array_filter(array_map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->title,
                    ];
                }, Product::storecards()->data), fn($value) => ! is_null($value));
                break;
            case 'mails':
                $response = Http::get(config('url.docker') . '/api/notifications/get', [
                    'id' => Auth::user()->current_organization->identifier]);
                foreach ($response->json()['data'] as $brand) {
                    $items = array_filter(array_map(function ($item) {
                        return [
                            'id' => $item['id'],
                            'name' => $item['title'],
                        ];
                    }, $brand['mails']), fn($value) => ! is_null($value));
                    $this->items = array_merge($this->items, $items);
                }
                break;
          
            case 'categories':
                $this->items = array_filter(array_map(function ($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->tag,
                    ];
                },  Tag::get()->data), fn($value) => ! is_null($value));
                break;
        }
    }

    public function castComponent($model)
    {
        $cast = [];
        $array = [];
        foreach ($this->items as $item) {
            $array[] = $item['id'];
        }

        if ($this->multiple) {
            foreach ($array as $item) {
                if (in_array($item, $this->{$model})) {
                    $cast[$item] = true;
                } else {
                    $cast = false;
                }
            }
        }
    
        if ($this->multiple){
            if ($this->emit_to_parent) {
                $this->emit($this->parent_listener, [$model => $cast]);
                } else {
                $this->emit('updatedCustomComponent', [$model => $cast]);
            }
        } else {
            if ($this->emit_to_parent) {
                $this->emit($this->parent_listener, [$model => $this->{$model}]);
                } else {
                $this->emit('updatedCustomComponent', [$model => $this->{$model}]);
            }
        }
      
    }

    public function render()
    {
        return view('walletapp::model-select');
    }
}
