<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    private $detail;
    private $edit;
    private $delete;

    /**
     * Create a new component instance.
     */
    public function __construct($detail, $edit, $delete)
    {
        $this->detail = $detail;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button', [
            'detail' => $this->detail,
            'edit' => $this->edit,
            'delete' => $this->delete,
        ]);
    }
}
