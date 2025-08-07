<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusPublish extends Component
{
    /**
     * Create a new component instance.
     */

    public $status;
    public $color;
    public function __construct($status)
    {
        $this->status = $status;

        // Tentukan warna berdasarkan status
        if ($status == 'Publish') {
            $this->color = 'green';
        } elseif ($status == 'Draft') {
            $this->color = 'yellow';
        } else {
            $this->color = 'gray'; // Default warna untuk status yang tidak dikenali
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-publish');
    }
}
