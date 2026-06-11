<?php

namespace App\Livewire\Accounts;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public string $name = '';

    public ?string $initial_balance = null;

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'initial_balance' => ['nullable', 'numeric', 'decimal:0,2', 'between:-99999999.99,99999999.99'],
        ]);

        $account = new Account;
        $account->name = $validated['name'];
        $account->initial_balance = $validated['initial_balance'] ?? null;

        Auth::user()->accounts()->save($account);

        $this->redirectRoute('accounts.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.accounts.create');
    }
}
