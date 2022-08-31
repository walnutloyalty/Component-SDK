<?php

namespace Walletapp\Components\Components\Search;

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

    public function lookup($item)
    {
        $this->dispatchBrowserEvent('openloader');
        $http = Http::post(config('url.docker') . '/api/search', [
            'search' => $item,
            'organization_id' => auth()->user()->current_organization->id,
        ]);
        dd($http->json(), $item);
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
        return view('walletapp::search.recent');
    }
}
