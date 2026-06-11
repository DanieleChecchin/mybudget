<?php

namespace App\Livewire\Accounts;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Account $account;

    public string $name = '';

    public ?string $initial_balance = null;

    public function mount(Account $account): void
    {
        $this->account = Auth::user()->accounts()->findOrFail($account->getKey());
        $this->name = $this->account->name;
        $this->initial_balance = $this->account->initial_balance;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'initial_balance' => ['nullable', 'numeric', 'min:0'],
        ]);

        $account = Auth::user()->accounts()->findOrFail($this->account->getKey());
        $account->name = $validated['name'];
        $account->initial_balance = $validated['initial_balance'] ?? null;
        $account->save();

        $this->redirectRoute('accounts.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.accounts.edit');
    }
}
