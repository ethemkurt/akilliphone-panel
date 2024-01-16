<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class CheckboxInput extends Component
{
    public $label;
    public $name;
    public $id;
    public $checked;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $id, $checked=false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.checkbox-input');
    }
}
