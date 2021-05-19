<?php

namespace App\View\Components;

use Illuminate\View\Component;

class textarea extends Component
{
    public $key;
    public $name;
    public $value; // Default: null
    public $rows; // Default: 3
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($key, $name, $rows = 3, $value = null)
    {
        $this->key = $key;
        $this->name = $name;
        $this->value = $value;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <label for="{{ $key }}">{{ $name }}:</label>
            <textarea name="{{ $key }}" id="{{ $key }}" rows="{{ $rows ?? 3 }}" class="form-control" 
                placeholder="{{ $name }}">{{ $value ?? null }}</textarea>
        blade;
    }
}
