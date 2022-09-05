<?php

namespace Walletapp\Components\Components;

use App\Imports\UserImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Excel;
use Exception;

class Csv extends Component
{
    use WithFileUploads;

    public $label; 
    public $type;
    public $primary_headers = [];
    public $message = 'required headers not found:';
    public $headers = [];
    public $data = [];
    public $csv_import;
    public $pickable_headers = [];
    public $selected_headers = [];

    //general mounting function

    /**
     * @throws Exception
     */
    public function mount()
    {
        if (count($this->primary_headers) === 0) {
            throw new Exception('No required headers set on csv reader component');
        }
        foreach($this->primary_headers as $header) {
            $this->message .= ' '. $header;
        }
    }

    // reset component to original state
    public function tryAgain()
    {
        $this->resetExcept('pickable_headers', 'primary_headers', 'message', 'label');
        $this->dispatchBrowserEvent('openfirst');
    }

    // process the incomming Import
    public function updatedCsvImport()
    {
        // check the import type, allows csv, xls, xlsx
        $imported = [];
        $data = Excel::toArray(new UserImport, $this->csv_import)[0];

        foreach ($data as $key => $array) {
            if (! array_diff($this->primary_headers, $array)) {
                $this->headers = $array;
                unset($data[$key]);
            }
        }

        // the primary headers provided to the element are not found return an error
        if (count($this->headers) == 0) {
            $this->dispatchBrowserEvent('csverror');
        } else {
            // set the data and remove the header row from the import.
            $this->data = $data;
            foreach ($this->headers as $key => $header) {
                if (empty($header)) {
                    unset($this->headers[$key]);
                }
            }
            $this->dispatchBrowserEvent('selectheaders');
        }
    }

    // validate the header relations the user provided
    public function validateHeaders()
    {
        foreach ($this->data as $row_key => $row) {
            foreach ($row as $key => $item) {
                if (isset($this->selected_headers[$key])) {
                    $this->data[$row_key][$this->selected_headers[$key]] = $item;
                }
                unset($this->data[$row_key][$key]);
            }
        }
        
        // after parsing emit the data to the parent component
        $this->dispatchBrowserEvent('csvdone');
        $this->emit('formData', $this->data);    
    }

    public function render()
    {
        return view('walletapp::csv');
    }
}
