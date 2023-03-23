<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class TextField extends Component
{
    public $rows;
    public $name;
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $rows)
    {
        $this->label = $label;
        $this->rows = $rows;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.text-field');
    }
}
