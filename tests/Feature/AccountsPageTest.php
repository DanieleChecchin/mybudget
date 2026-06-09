<?php

namespace Tests\Feature;

use App\Livewire\Accounts\Create;
use App\Livewire\Accounts\Edit;
use App\Livewire\Accounts\Index;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_accounts_pages_require_authentication(): void
    {
        $account = $this->createAccount();

        $this->get(route('accounts.index'))->assertRedirect(route('login'));
        $this->get(route('accounts.create'))->assertRedirect(route('login'));
        $this->get(route('accounts.edit', $account))->assertRedirect(route('login'));
    }

    public function test_accounts_index_page_is_displayed(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('accounts.index'));

        $response
            ->assertOk()
            ->assertSeeLivewire(Index::class)
            ->assertSeeText('Accounts')
            ->assertSeeText('New Account')
            ->assertSee(route('accounts.create'), escape: false)
            ->assertSeeText('No accounts to display.');
    }

    public function test_accounts_create_page_is_displayed(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get(route('accounts.create'));

        $response
            ->assertOk()
            ->assertSeeLivewire(Create::class)
            ->assertSeeText('Create Account')
            ->assertSeeText('Account creation content will be added here.');
    }

    public function test_accounts_edit_page_is_displayed(): void
    {
        $account = $this->createAccount();

        $response = $this->actingAs($account->user)
            ->get(route('accounts.edit', $account));

        $response
            ->assertOk()
            ->assertSeeLivewire(Edit::class)
            ->assertSeeText('Edit Account')
            ->assertSeeText('Account editing content will be added here.');
    }

    private function createAccount(): Account
    {
        $account = new Account;
        $account->user()->associate(User::factory()->create());
        $account->name = 'Checking Account';
        $account->save();

        return $account;
    }
}
