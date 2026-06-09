<?php

namespace App\Livewire\Accounts;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public function render()
    {
        return view('livewire.accounts.create');
    }
}
