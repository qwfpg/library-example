<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends AbstractFormComponent
{
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
