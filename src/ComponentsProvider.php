<?php

namespace Walletapp\Components;

use App\Http\Livewire\Components\Breadcrumbs;
use App\Http\Livewire\Components\Create;
use App\Http\Livewire\Components\Csv;
use App\Http\Livewire\Components\Feed;
use App\Http\Livewire\Components\Form;
use App\Http\Livewire\Components\Graph;
use App\Http\Livewire\Components\Loader;
use App\Http\Livewire\Components\ModelSelect;
use App\Http\Livewire\Components\Notification;
use App\Http\Livewire\Components\Preview;
use App\Http\Livewire\Components\Search\Action;
use App\Http\Livewire\Components\Search\Input;
use App\Http\Livewire\Components\Search\Recent;
use App\Http\Livewire\Components\Search\Result;
use App\Http\Livewire\Components\SingleList;
use App\Http\Livewire\Components\Stat;
use App\Http\Livewire\Components\WebshopOrder;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Blade;

class ComponentsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'walletapp');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('walletapp::search.action', Action::class);
        Livewire::component('walletapp::search.input', Input::class);
        Livewire::component('walletapp::search.recent', Recent::class);
        Livewire::component('walletapp::search.result', Result::class);
        Livewire::component('walletapp::breadcrumbs', Breadcrumbs::class);
        Livewire::component('walletapp::create', Create::class);
        Livewire::component('walletapp::csv', Csv::class);
        Livewire::component('walletapp::feed', Feed::class);
        Livewire::component('walletapp::form', Form::class);
        Livewire::component('walletapp::graph', Graph::class);
        Livewire::component('walletapp::loader', Loader::class);
        Livewire::component('walletapp::model.select', ModelSelect::class);
        Livewire::component('walletapp::notification', Notification::class);
        Livewire::component('walletapp::preview', Preview::class);
        Livewire::component('walletapp::list.single', SingleList::class);
        Livewire::component('walletapp::list.stacked', StackedList::class);
        Livewire::component('walletapp::statistic', Stat::class);
        Livewire::component('walletapp::webshop.order', WebshopOrder::class);
    }
}
