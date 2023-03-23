<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class EmailInput extends Component
{
    public $label;
    public $name;
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $placeholder)
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.email-input');
    }
}
