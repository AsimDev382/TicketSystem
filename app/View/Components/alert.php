<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alert extends Component
{
    public $type;
    public $message;
    public $dismissible;
    /**
     * Create a new component instance.
     */
    public function __construct($type, $message, $dismissible = false)
    {
        $this->type = $type;
        $this->message = $message;
        $this->dismissible = $dismissible;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.component.alert');
    }
}
