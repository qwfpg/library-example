<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends AbstractFormComponent
{
    public string $type;
    public ?int $min;
    public ?int $max;

    public function __construct(
        string $title,
        string $name,
        string $value = '',
        bool   $required = false,
        string $type = 'text',
        int $min = null,
        int $max = null,
    )
    {
        parent::__construct($title, $name, $value, $required);
        $this->type = $type;
        $this->min = $min;
        $this->max = $max;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
