<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputLive extends Component
{
    public $property_name;
    public $valuenya;
    public $edit_status = false;
    public $options;
    public $type_input;

    public $listeners = ['toggleEdit','refreshData'];

    public function mount($property_name, $value, $type_input, $options = null)
    {
        $this->property_name = $property_name;
        $this->valuenya = $value;
        $this->type_input = $type_input;
        $this->options = explode('|', $options);
    }

    public function render()
    {
        return view('livewire.input-live');
    }

    public function toggleEdit()
    {
        if($this->edit_status == true) {
            $this->saveData();
        }
        $this->edit_status = !$this->edit_status;
    }

    public function saveData()
    {
        $arrayData = [
            'property_name' => $this->property_name,
            'value' => $this->valuenya,
        ];

        $this->emitTo('formworkmode', 'savePatientData', $arrayData);
    }
}
