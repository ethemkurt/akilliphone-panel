<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $items;
    public $name;
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $items)
    {
        $this->label = $label;
        $this->name = $name;
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.select-input');
    }
}
