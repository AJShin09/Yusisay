<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class postCard extends Component
{
    public $username;
    public $time;
    public $content;
    public $commentsCount;
    public $postId;

     public function __construct($username, $time, $content, $commentsCount, $postId)
    {
        $this->username = $username;
        $this->time = $time;
        $this->content = $content;
        $this->commentsCount = $commentsCount;
        $this->postId = $postId;
    }

    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
