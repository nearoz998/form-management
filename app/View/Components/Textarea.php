<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $disabled;
    public $rows;

    public function __construct($disabled = false, $rows = 4)
    {
        $this->disabled = $disabled;
        $this->rows = $rows;
    }

    public function render()
    {
        return view('components.textarea');
    }
}
