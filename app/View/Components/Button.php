<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $buttonType;
    public $value;
    public $label;

    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $buttonType, $value, $label)
    {
        $this->type = $type;
        $this->buttonType = $buttonType;
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
