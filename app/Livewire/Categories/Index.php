<?php

namespace App\Livewire\Categories;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete(int $category): void
    {
        Auth::user()->categories()->findOrFail($category)->delete();
    }

    public function render()
    {
        return view('livewire.categories.index', [
            'categories' => Auth::user()->categories()->get(),
        ]);
    }
}
