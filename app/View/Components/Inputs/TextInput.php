<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class TextInput extends Component
{

    public $name;
    public $label;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $placeholder)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.text-input');
    }
}
