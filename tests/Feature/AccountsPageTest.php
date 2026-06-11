<?php

namespace Tests\Feature;

use App\Livewire\Accounts\Create;
use App\Livewire\Accounts\Edit;
use App\Livewire\Accounts\Index;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
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
            ->assertSeeText('Name')
            ->assertSeeText('Initial Balance')
            ->assertSeeText('Cancel');
    }

    public function test_account_can_be_created_for_the_authenticated_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Create::class)
            ->set('name', 'Checking Account')
            ->set('initial_balance', '125.50')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('accounts.index', absolute: false));

        $this->assertDatabaseHas('accounts', [
            'user_id' => $user->id,
            'name' => 'Checking Account',
            'initial_balance' => 125.50,
        ]);
    }

    public function test_initial_balance_is_optional_when_creating_an_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        Livewire::test(Create::class)
            ->set('name', 'Cash')
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('accounts.index', absolute: false));

        $this->assertDatabaseHas('accounts', [
            'user_id' => $user->id,
            'name' => 'Cash',
            'initial_balance' => null,
        ]);
    }

    public function test_account_creation_requires_valid_input(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('name', '')
            ->set('initial_balance', 'invalid')
            ->call('save')
            ->assertHasErrors([
                'name' => 'required',
                'initial_balance' => 'numeric',
            ])
            ->assertNoRedirect();

        $this->assertDatabaseCount('accounts', 0);
    }

    public function test_initial_balance_cannot_have_more_than_two_decimal_places(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(Create::class)
            ->set('name', 'Checking Account')
            ->set('initial_balance', '12.345')
            ->call('save')
            ->assertHasErrors(['initial_balance' => 'decimal'])
            ->assertNoRedirect();

        $this->assertDatabaseCount('accounts', 0);
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
