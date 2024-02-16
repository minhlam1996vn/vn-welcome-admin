<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The type of the alert (success or danger).
     *
     * @var string
     */
    public $type;

    /**
     * The message to be displayed in the alert.
     *
     * @var string
     */

    public $message;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Determine the type and message for the alert based on session data
        $this->type = session('success') ? 'success' : 'danger';
        $this->message = session('success') ?? session('error') ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
