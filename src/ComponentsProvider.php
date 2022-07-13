<?php

namespace Walletapp\Components;

use Walletapp\Components\Breadcrumbs;
use Walletapp\Components\Create;
use Walletapp\Components\Csv;
use Walletapp\Components\Feed;
use Walletapp\Components\Form;
use Walletapp\Components\Graph;
use Walletapp\Components\Loader;
use Walletapp\Components\ModelSelect;
use Walletapp\Components\Notification;
use Walletapp\Components\Preview;
use Walletapp\Components\Search\Action;
use Walletapp\Components\Search\Input;
use Walletapp\Components\Search\Recent;
use Walletapp\Components\Search\Result;
use Walletapp\Components\SingleList;
use Walletapp\Components\Stat;
use Walletapp\Components\WebshopOrder;
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
