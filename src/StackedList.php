<?php

namespace Walletapp\Components;

use Exception;
use Livewire\Component;

class StackedList extends Component
{

    // the data and header arrays for the list
    public $data = [];
    public $unfiltered = []; 
    public $search;
    public $list_id;

    public $create;
    
    public $hidden = [];
    // if a onclick event is cast using the link_keys array. send the object with the request, name needs to be configured
    public $cast_object_on_click = false;

    // set svg icons, look in blade for options, example [<string object_key_name> => <string svg_name>]
    public $svgs = [];

    // if you dont want the entire object to be cast then define the specific key here
    public $cast_key = '';

    public $use_pagination = false;

    // set the filter array
    public $use_filters = false;
    
    // the array for which header needs to be used as an image, format: [<string>]
    public $image_keys = [];

    // the array for which header should be an anchor tag. format: [<string key> => <string destination:route, url>]
    public $link_keys = [];

    public $page = 0;

    // provide an array with options like save and archive, if cast_object_on_click is enabled, object will be casted to this option, example: [ <string option_name> => ['type' => <: string|emit, route_name, url>, 'option_value' => <string value>, "cast_name" => <string the receiving name of the object>, 'color' => <string tailwindcss_color_name:red|blue|sky|indigo|etc..]]
    public $options = [];

    
    public $current_stack = [];
    // for this component the mount function will be used as a validation function
   

    public function getListeners()
    {
        if ($this->list_id) {
            return [
                'remount-'.$this->list_id => 'remount'
            ]; 
        
        } 
        return [
            'remount' => 'remount'
        ]; 
    
    }
    public function remount($data = [])
    {
        if (count($data) > 0) {
            $this->data = $data;
        }
        $this->unfiltered = $this->data;
        $this->chunk();
    }

    public function mount()
    {
        $this->unfiltered = $this->data;
        $this->chunk();
    }

 
    // if a button or option is clicked execute this handler
    public function executeOption($option, $record)
    {
        // fetch the required record, option and type
        $option = $this->options[$option];
        $record = $this->current_stack[$record];
        $type = $option['type'];
        // determine the buttons function and execute the handler accordingly
        switch($type) {
            case 'emit':
                    if($this->cast_object_on_click) {
                        if (isset($this->cast_key)) {
                            $record = $record[$this->cast_key];
                        }
                        if (! empty($option['cast_name'])) {
                            $this->emit($option['option_value'], [! empty($option['cast_name']) ? $option['cast_name'] : 'data' => $record]);

                        } else {
                            $this->emit($option['option_value'], $record);
                        }

                    } else {
                        $this->emit($option['option_value']);
                    }
                break;
            case 'url':
                return redirect($option['option_value']);
                break;
            case 'to_key':
                return redirect($record[$option['option_value']]);
                break;
            case 'route':
                if($this->cast_object_on_click) {
                    if (isset($this->cast_key)) {
                        $record = $record[$this->cast_key];
                    }
                    if (! empty($option['cast_name'])) {
                        $body = [! empty($option['cast_name']) ? $option['cast_name'] : 'data' => $record];
                    } else {
                        $body = $record;
                    }
                    return redirect()->route($option['option_value'], $body);
                } else {
                    return redirect()->route($option['option_value']);
                }
                break;
        }
    }

    public function updatedSearch($search_value)
    {
        if (! empty($search_value)) {
            $new_data = [];
            foreach($this->unfiltered as $item) {
                $set = false;
                foreach ($item as $value) {
                    if (! $set) {
                        if(str_contains($value, $search_value)) {
                            $set = true;
                            $new_data[] = $item;
                        }
                    }
                }
            }
            $this->data = $new_data;
        } else {
            $this->data = $this->unfiltered;
        }
        $this->chunk();
    }

    public function nextPage()
    {
        if( isset($this->data[$this->page + 1])) {
            $this->page++;
            $this->current_stack = isset($this->data[$this->page]) ? $this->data[$this->page] : [];   
        }
    }

    public function lastPage()
    {
        if( isset($this->data[$this->page - 1])) {
            $this->page--;
            $this->current_stack = isset($this->data[$this->page]) ? $this->data[$this->page] : [];   
        }  
    }

    private function chunk()
    {
        $this->data = array_chunk($this->data, 10);
        $this->current_stack = isset($this->data[$this->page]) ? $this->data[$this->page] : [];      
    }

    public function render()
    {
        return view('walletapp::stacked-list');
    }
}
