<x-slot name="header">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts') }}
        </h2>

        <a href="{{ route('accounts.create') }}" wire:navigate>
            <x-primary-button>
                {{ __('New Account') }}
            </x-primary-button>
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                {{ __('Name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                {{ __('Initial Balance') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($accounts as $account)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $account->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ number_format((float) ($account->initial_balance ?? 0), 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-sm text-gray-500">
                                    {{ __('No accounts to display.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
