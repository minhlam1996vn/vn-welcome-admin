<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    /**
     * The pagination links to be displayed.
     *
     * @var mixed
     */
    public $links;

    /**
     * The flag to determine whether to show the limit information.
     *
     * @var mixed
     */
    public $showLimit;

    /**
     * Create a new component instance.
     *
     * @param mixed $links The pagination links.
     * @param mixed $showLimit Flag to determine whether to show the limit information.
     */
    public function __construct($links, $showLimit)
    {
        $this->links = $links;
        $this->showLimit = $showLimit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
