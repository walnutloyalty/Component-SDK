<?php

namespace App\Http\Livewire\Components;

use Exception;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Form extends Component
{

    public $inputs, $title, $subtitle, $submit_url, $organization_id, $user_id, $submit_method;
    public $rules = [];
    public $call_component_update = true;

    public $listeners = [
        'updatedCustomComponent' => 'updatedCustomComponent',
        'openEdit' => 'edit'
    ];


    public function edit($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function updatedCustomComponent($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function mount()
    {
        if (! $this->title) {
            throw new Exception('No title defined on form component');
        }

      
        foreach ($this->inputs as $input) {

            if( isset($input['value'])) {
                $this->{$input['model']} = $input['value'];
            } else {
                $this->{$input['model']} = null;
            }
            $this->rules[$input['model']] = $input['rules'];
        }

        if(auth()->user()->current_organization) {
            $this->organization_id = auth()->user()->current_organization->id;
        }
        $this->user_id = auth()->user()->id;
    }

    public function componentUpdated($data)
    {
        // implement emit to parent componentent when required
    }


    public function submit()
    {
        $data = $this->validate();
        $http = Http::{$this->submit_method}(config('url.docker') . $this->submit_url, $data);
        if($http->status() == 500) {
        if (! app()->environment(['staging', 'production'])) {
                dd($http->body());
            } else {
                $this->dispatchBrowserEvent('notify', ['content' => 'Something went wrong', 'type' => 'error']);
            }
        } elseif($http->status() == 200) {
            if (isset($http->json()['message'])) { 
                $this->dispatchBrowserEvent('notify', ['content' => $http->json()['message'], 'type' => 'success']);
            } else {
                $this->dispatchBrowserEvent('notify', ['content' => 'Task completed', 'type' => 'success']);
            }
        } else {
            if (isset($http->json()['message'])) { 
                $this->dispatchBrowserEvent('notify', ['content' => $http->json()['message'], 'type' => 'error']);
            } else {
                $this->dispatchBrowserEvent('notify', ['content' => 'Something went wrong', 'type' => 'error']);
            }
        }
    }

    public function render()
    {
        return view('walletapp::form');
    }
}
