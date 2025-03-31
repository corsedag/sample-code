<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $id;

    public $label;

    public $path;

    public $unit;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $label, $path, $unit = '')
    {
        $this->id = $id;
        $this->label = $label;
        $this->path = $path;
        $this->unit = $unit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
