<?php

namespace Walletapp\Components;

use Walletapp\Components\Components\Breadcrumbs;
use Walletapp\Components\Components\Create;
use Walletapp\Components\Components\Csv;
use Walletapp\Components\Components\Feed;
use Walletapp\Components\Components\Form;
use Walletapp\Components\Components\Graph;
use Walletapp\Components\Components\Loader;
use Walletapp\Components\Components\ModelSelect;
use Walletapp\Components\Components\StackedList;
use Walletapp\Components\Components\Notification;
use Walletapp\Components\Components\Preview;
use Walletapp\Components\Components\Search\Action;
use Walletapp\Components\Components\Search\Input;
use Walletapp\Components\Components\Search\Recent;
use Walletapp\Components\Components\Search\Result;
use Walletapp\Components\Components\SingleList;
use Walletapp\Components\Components\Stat;
use Walletapp\Components\Components\WebshopOrder;
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
        $this->publishes([
            __DIR__.'/resources/' => resource_path() . '/resources/walletapp'
        ], 'resources');

        $this->publishes([
            __DIR__.'/components/' => app_path() . '/Http/Livewire/WalletApp'
        ], 'components');
         
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
