<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class deleteCommentButton extends Component
{
    public function __construct()
    {

    }

    public function render(): View|Closure|string
    {
        return view('components.delete-comment-button');
    }
}
