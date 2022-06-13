<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $buttonName;
    public $icon;
    public function __construct($buttonName, $icon)
    {
        $this->buttonName = $buttonName;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.submit-button');
    }
}
