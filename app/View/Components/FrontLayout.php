<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{

    public $isBannerShow = true;
    /**
     * Create a new component instance.
     */
    public function __construct($isBannerShow = true)
    {
        $this->isBannerShow = $isBannerShow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front');
    }
}
