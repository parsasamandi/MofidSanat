<?php

namespace App\View\Components;

use Illuminate\View\Component;

class service extends Component
{
    public $title;
    public $description;
    public $fontAwsome;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $fontAwesome)
    {
        $this->title = $title;
        $this->description = $description;
        $this->fontAweosme = $fontAwesome;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.home.service');
    }
}
