<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends AbstractFormComponent
{
    public string $type;

    public function __construct(
        string $title,
        string $name,
        string $value = '',
        bool   $required = false,
        string $type = 'text'
    )
    {
        parent::__construct($title, $name, $value, $required);
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
