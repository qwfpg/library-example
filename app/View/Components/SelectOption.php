<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectOption extends AbstractFormComponent
{
    public bool $selected;

    public function __construct(
        string $title,
        string $name,
        string $value = '',
        bool   $required = false,
        bool   $selected = false
    )
    {
        parent::__construct($title, $name, $value, $required);
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        return view('components.select-option');
    }
}
