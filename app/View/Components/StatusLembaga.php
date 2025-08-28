<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusLembaga extends Component
{
    /**
     * Create a new component instance.
     */
    public $status;
    public $color;
    public function __construct($status)
    {
        $this->status = $status != 1 ? 'SMP Darun Ihsan' : 'MA Darun Ihsan';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-lembaga');
    }
}
