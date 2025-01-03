<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    public $type;
    public $class;
    public $atributes;
    public $color;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'button', $class = null, $atributes = null, $color = 'primary')
    {
        $this->type = $type;
        $this->class = $class;
        $this->atributes = $atributes;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
