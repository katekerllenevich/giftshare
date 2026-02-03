<?php

namespace App\Livewire\List\Category;

use App\Models\Category;
use App\Models\Lists;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class CategorySection extends Component
{
    #[Locked]
    public Lists $list;

    #[Locked]
    public ?Category $category = null;

    public bool $expanded = false;

    public function toggleExpand()
    {
        if ($this->expanded) {
            $this->expanded = false;
        } else {
            if (is_null($this->category)) {
                $this->dispatch('close-all', id: '');
            } else {
                $this->dispatch('close-all', id: $this->category->id);
            }
            $this->expanded = true;
        }
    }

    #[On('close-all')]
    public function closeAll(string $id)
    {
        $categoryId = is_null($this->category) ? '' : $this->category->id;
        if ($categoryId !== $id) {
            $this->expanded = false;
        }
    }

    #[On('updated-category')]
    public function reload()
    {
        $this->category->refresh();
    }

    public function render()
    {
        return view('list.items.category.category-section');
    }
}
