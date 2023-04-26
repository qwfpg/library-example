<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Select extends AbstractFormComponent
{
    public ?Collection $options;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $name, string $value = '',  Collection $options = null)
    {
        parent::__construct($title, $name, $value);
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
