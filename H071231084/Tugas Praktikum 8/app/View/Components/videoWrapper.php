<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class videoWrapper extends Component
{
    public $src;
    public function __construct($src)
    {
        $this->src = $src;
    }

    public function render(): View|Closure|string
    {
        return view('components.video-wrapper');
    }
}
