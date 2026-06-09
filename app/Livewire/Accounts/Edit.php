<?php

namespace App\Livewire\Accounts;

use App\Models\Account;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Account $account;

    public function mount(Account $account): void
    {
        $this->account = $account;
    }

    public function render()
    {
        return view('livewire.accounts.edit');
    }
}
