<div>
    <div @class([
    "bg-white py-5 px-7 rounded-t-md border-t border-x flex justify-between items-center cursor-pointer",
    "rounded-md border border-gray-200" => !$expanded,
    "border-b border-b-gray-200 border-gray-300" => $expanded
]) wire:click.self="toggleExpand">
        <span>
            @if(isset($category))
                {{ $category->name }}
            @else
                Uncategorized
            @endif
        </span>

        <div class="flex gap-1">
            @if (isset($category))
                <livewire:list.category.category-settings-form :category="$category"/>
            @endif

            <button aria-label="expand {{ isset($category) ? $category->name : 'uncategorized' }}"
                    wire:click="toggleExpand"
                    class="flex border-2 border-transparent rounded-md hover:border-gray-100 focus:outline-none focus:border-gray-200 transition">
                @if ($expanded)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                @endif
            </button>
        </div>
    </div>

    @if ($expanded)
        <div class="bg-gray-50 rounded-b-md border-gray-300 border-x border-b">
            <livewire:list.items.items-table :list="$list" :category="$category" :uncategorized="is_null($category)"/>
        </div>
    @endif
</div>
