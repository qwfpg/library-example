<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

abstract class AbstractFormComponent extends Component
{
    public string $title;
    public string $name;
    public string $value;
    public bool $required;

    public function __construct(string $title, string $name, string $value = '', bool $required = false)
    {
        $this->title = $title;
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
    }
}
