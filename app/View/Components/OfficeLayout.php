<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OfficeLayout extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $this->title = $title ?? 'Perpustakaan Lumban Dolok';
    }

    public function render()
    {
        return view('theme.office.index');
    }
}
