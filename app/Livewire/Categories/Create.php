<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Create extends Component
{
    public string $name = '';

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = new Category;
        $category->name = $validated['name'];

        Auth::user()->categories()->save($category);

        $this->redirectRoute('categories.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
