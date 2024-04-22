<?php

namespace App\Livewire\SitePages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class MainPage extends Component
{
    #[Layout('layouts.guest')]
    public function render()
    {
        return view('livewire.site-pages.main-page');
    }
}
