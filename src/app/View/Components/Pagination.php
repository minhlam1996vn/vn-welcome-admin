<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $links;
    public $showLimit;

    /**
     * Create a new component instance.
     */
    public function __construct($links, $showLimit)
    {
        $this->links = $links;
        $this->showLimit = $showLimit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
