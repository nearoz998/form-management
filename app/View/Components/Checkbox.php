<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $disabled;
    public $checked;

    public function __construct($disabled = false, $checked = false)
    {
        $this->disabled = $disabled;
        $this->checked = $checked;
    }

    public function render()
    {
        return view('components.checkbox');
    }
}
