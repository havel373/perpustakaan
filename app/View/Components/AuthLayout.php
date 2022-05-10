<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $this->title = $title ?? 'Autentikasi';
    }

    public function render()
    {
        return view('theme.office.auth.index');
    }
}
