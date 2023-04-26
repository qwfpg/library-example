<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * Create a new component instance.
     */
    public string $action;
    public string $method;
    public string $indexRoute;

    public function __construct(string $action, string $method = 'POST', string $indexRoute = 'admin')
    {
        $this->action = $action;
        $this->method = $method;
        $this->indexRoute = $indexRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
