<?php

namespace App\View\Components;
use App\Models\Product;
use Illuminate\View\Component;

class products extends Component
{

    public $page;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        if($this->page == "home")   
            $product['products'] = Product::whereHas('statuses', function($query) {
                $query->active();
            })->paginate(6);
            
        else if($this->page == "product")
            $product['products'] = Product::where('status',1)->paginate(9);
        
        return view('components.product', $product);
    }

}
