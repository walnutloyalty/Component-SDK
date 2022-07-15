<?php

namespace Walletapp\Components;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

use Livewire\WithFileUploads;
use Livewire\TemporaryUploadedFile;

use Image;
use Storage;
use Str;

class Create extends Component
{
    use WithFileUploads;

    public $organization_id;

    public $user_id;

    public $tabs = [];

    public $inputs = [];
    
    public $options = [];

    public $call_component_update = false;

    public $preview = false;

    public $preview_component;

    public $component_key;

    public $rules = [];

    public $assets = [];

    public $multi_assets = [];

    public $custom_rules = [];

    public $multi_previews = [];

    private $closures = [];

    public $base_settings = [];

    public $updated_values = [];

    public $fetch_api;
    public $update_search_key;

    public $update_identifier;

    public $update_mode = false;

    public $listeners = [
        'updatedCustomComponent' => 'updatedCustomComponent',
        'componentCreateEdit' => 'edit',
        'componentCreateOpen' => 'open',
    ];

    public $fetch_apis = [
        'coupon' => ['GET', '/api/coupon/inspect/', true],
        'lead' => ['GET', '/api/landingpages/show/', true],
        'product' => ['GET', '/api/product/inspect/', true],
        'storecard' => ['GET', '/api/storecard/inspect/', true],
        'offer' => ['GET', '/api/online/inspect/', true]
    ];

    public function edit($data)
    {
        $key = array_keys($data)[0];
        $value = array_values($data)[0];
        $explode = explode('_', $key);
        
        if(count($explode) > 1)  {
            $this->update_search_key = $explode[0];
            $this->update_identifier = $value;
            $this->fetch_api = isset($this->fetch_apis[$this->update_search_key]) ? $this->fetch_apis[$this->update_search_key] : null;
        }

        if ($this->fetch_api) { 
            $this->update_mode = true;
            if ($this->fetch_api[2]) {
                $url = config('url.docker'). $this->fetch_api[1]. $value;
            } else {
                $url = config('url.docker'). $this->fetch_api[1];
            }

            $http = Http::{$this->fetch_api[0]}($url);
            if ($http->status() === 200) {
                $http = $http->json();
                if (isset($http['data'])) {
                        $http = $http['data'];     
                }
                foreach($http as $key => $value) {
                        $this->{$key} = $value;
                } 
                $this->emit('componentUpdate', $http);
            }
        }
        $this->rules['update_identifier'] = 'required';

        $this->dispatchBrowserEvent('opencreate');
    }

    public function mount()
    {
        $this->organization_id = auth()->user()->current_organization->id;
        $this->user_id = auth()->user()->id;
        foreach ($this->tabs as $tab) {
            foreach ($tab['inputs'] ?? [] as $input) {
                if (isset($input['component'])) {
                    if($input['component'] === 'image') {
                        $this->{$input['model'] .'_url'} = null;
                        $this->base_settings[$input['model'] .'_url'] = null;
    
                        $this->assets[] = $input['model'] .'_url';
                    }elseif($input['component'] === 'multi-image') {
                        $this->{$input['model']} = null;
                        $this->base_settings[$input['model']] = null;
    
                        $this->multi_assets[] = $input['model'];
                    } elseif($input['component'] === 'color') { 
                        $this->{$input['model']} = '#000000';
                    } else {
                        if(isset($input['default'])) { 
                            $this->{$input['model']} = $input['default'];
                        } else {
                            $this->{$input['model']} = null;
                        }
                        $this->base_settings[$input['model']] = null;
                    } 
                } else {
                    if($input['custom_component'] === 'image') {
                        $this->{$input['model'] .'_url'} = null;
                        $this->base_settings[$input['model'] .'_url'] = null;
    
                        $this->assets[] = $input['model'] .'_url';
                    }elseif($input['custom_component'] === 'multi-image') {
                        $this->{$input['model']} = null;
                        $this->base_settings[$input['model']] = null;
    
                        $this->multi_assets[] = $input['model'];
                    } elseif($input['custom_component'] === 'color') { 
                        $this->{$input['model']} = '#000000';
                    } else {
                        if(isset($input['default'])) { 
                            $this->{$input['model']} = $input['default'];
                        } else {
                            $this->{$input['model']} = null;
                        }
                        $this->base_settings[$input['model']] = null;
    
                    }
                }
                if (isset($input['component'])) {
                    if ($input['component'] === 'image') {
                        $this->rules[$input['model'] .'_url'] = $input['rules'];
                    } else {
                        $this->rules[$input['model']] = $input['rules'];
                    }
                }
            }
        }

        foreach($this->custom_rules ?? [] as $key => $rule) {
            $this->rules[$key] = $rule;
        }
    }

    public function open($data = [])
    {
        foreach ($data as $key => $item) {
            $this->{$key} = $item;
        }
        $this->dispatchBrowserEvent('opencreate');
    }

    public function __call($method, $arguments)
    {           
        if ($method === 'updated' && isset($arguments[0]) && in_array($arguments[0], $this->assets)) {
            $this->updated_values[$arguments[0]] = $this->{$arguments[0]}->temporaryUrl();
            $this->emit('componentUpdate', [$arguments[0] => $this->{$arguments[0]}->temporaryUrl()]);
        } elseif($method === 'updated' && isset($arguments[0]) && in_array($arguments[0], $this->multi_assets)) {
            if(isset($this->multi_previews[$arguments[0]])) {
                unset($this->multi_previews[$arguments[0]]);
                unset($this->updated_values[$arguments[0]]);

            }
            $this->multi_previews[$arguments[0]] = [];

            foreach($this->{$arguments[0]} as $key => $image) {
                $this->updated_values[$arguments[0]][$key] = $image->temporaryUrl();
                $this->multi_previews[$arguments[0]][$key] = $image->temporaryUrl();
            }
        }
        
    }

    public function removeImage($model, $key)
    {
        if (isset($this->multi_previews[$model][$key])) {
            unset($this->multi_previews[$model][$key]);
        }
        if(isset($this->updated_values[$model][$key])) {
            unset($this->updated_values[$model][$key]);
        }
        if (isset($this->{$model}[$key])) {
            unset($this->{$model}[$key]);
        }
        $this->dispatchBrowserEvent('notify', ['content' => 'Removed image', 'type' => 'success']);

    }

    public function componentUpdated($key)
    {
        if (!in_array($key.'_url', $this->assets)) {
            $this->updated_values[$key] = $this->{$key};
            $this->emit('componentUpdate', [$key => $this->{$key}]);
        }
    }

    public function submit()
    {
        foreach($this->rules as $key => $value) {
            if(!isset($this->{$key})) {
                $this->{$key} = null;
            }
        }
        $data = $this->validate();
        $data = $this->parseFormats($data);
        if($this->update_mode) {
            $this->emit('formUpdateData', $data);
        } else {
            $this->emit('formData', $data);
        }
    }

    public function updatedCustomComponent($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function render()
    {
        return view('walletapp::create');
    }

    private function parseFormats($data)
    {
        foreach ($data as $key => $item) {
            if ($item instanceof TemporaryUploadedFile) {
                $data[$key] = $this->formatImage($item, $key);
            }

            if (gettype($item) === 'array') {
                foreach ($item as $sub_key => $sub_item) {
                    if ($sub_item instanceof TemporaryUploadedFile) {
                        $data[$key][$sub_key] = $this->formatImage($sub_item, $sub_key);
                    }
                } 
            }
            
            if (gettype($item) === 'string' &&  $item != strip_tags($item)) {
                $filename = strtoupper(Str::random(32) . time());
                Storage::disk('s3')->put("$key/descriptions/{$filename}.blade.php", $item);
                $data[$key] = "$key/descriptions/{$filename}.blade.php";
            } elseif(! $item instanceof TemporaryUploadedFile ) {
                $data[$key] = str_replace('https://frontend-image-bucket-production.s3.eu-central-1.amazonaws.com/', '', str_replace('https://frontend-image-bucket.s3.eu-central-1.amazonaws.com/', '', $item));
            }
        }
        return $data;
    }

    private function formatImage($item, $key)
    {
        $filepath = "create/$key/" . strtoupper(Str::random(32) . time());
        $extension = '.' . $this->{$key}->getClientOriginalExtension();

        foreach ([100, 200, 300, 400, 500, 600] as $item) {
            $image = \Image::make($this->{$key})->resize($item, $item, function ($constraint) {
                $constraint->aspectRatio();
            });
            $s3 = \Storage::disk('s3');
            if ($item === 600) {
                $s3->put($filepath . $extension, $image->stream(), 'public');
            } else {
                $s3->put($filepath . "-$item" . $extension, $image->stream(), 'public');
            }
        }
        return $filepath . $extension;
    }
}
