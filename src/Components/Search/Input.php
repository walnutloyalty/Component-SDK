<?php

namespace Walletapp\Components\Components\Search;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Input extends Component
{
    public $input;

    public $listeners = [
        'checkRecent' => 'checkRecent',
        'lookup' => 'lookup'
    ];

    public function lookup()
    {
        $this->emit('recent', $this->input);
        $this->dispatchBrowserEvent('openloader');
        $http = Http::post(config('url.docker') . '/api/search', [
            'search' => $this->input,
            'organization_id' => auth()->user()->current_organization->id,
        ]);
        if(!$http->failed()) {
            $this->emit('user', $http['user']);
            $this->emit('results', [
                'coupons' => $http['coupons'],
                'products' => $http['products'],
            ]);
        }
    }

    public function checkRecent($item)
    {
        $this->dispatchBrowserEvent('openloader');
        $http = Http::post(config('url.docker') . '/api/search', [
            'search' => $item,
            'organization_id' => auth()->user()->current_organization->id,
        ]);
        if(!$http->failed()) {
            $this->emit('user', $http['user']);
            $this->emit('results', [
                'coupons' => $http['coupons'],
                'products' => $http['products'],
            ]);
        }
    }

    public function render()
    {
        return view('walletapp::search.input');
    }
}
