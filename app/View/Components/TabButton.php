<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabButton extends Component
{
    /**
     * Create a new component instance.
     */
    public $tabs;
    public $activeTab;
    public function __construct(array $tabs, string $activeTab)
    {
        $this->tabs = $tabs;
        $this->activeTab = $activeTab;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tab-button');
    }
}
