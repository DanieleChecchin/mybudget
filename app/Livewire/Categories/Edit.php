<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Edit extends Component
{
    public Category $category;

    public string $name = '';

    public function mount(Category $category): void
    {
        $this->category = Auth::user()->categories()->findOrFail($category->getKey());
        $this->name = $this->category->name;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Auth::user()->categories()->findOrFail($this->category->getKey());
        $category->name = $validated['name'];
        $category->save();

        $this->redirectRoute('categories.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.categories.edit');
    }
}
