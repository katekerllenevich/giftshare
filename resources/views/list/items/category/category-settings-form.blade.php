<div>
    <button aria-label="{{ isset($category) ? $category->name : 'uncategorized' }} settings"
            wire:click="openSettings"
            class="flex border-2 border-transparent rounded-md focus:outline-none hover:border-gray-100 focus:border-gray-200 transition">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
             stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
        </svg>
    </button>

    <x-dialog-modal wire:model.live="settingsOpen">
        <x-slot name="title">
            {{ __($category->name . ' Settings') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" value="{{ __('Category Name') }}"/>
                <x-input type="text" class="mt-1 block w-3/4"
                         placeholder="{{ __('Category Name') }}"
                         wire:model="settingsState.name"
                         wire:keydown.enter="saveSettings"
                         required
                />
                <x-input-error for="name" class="mt-2"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-danger-button class="ms-3" wire:click="openDeleting" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>

            <x-secondary-button class="ms-3" wire:click="$toggle('settingsOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3"
                      wire:click="saveSettings"
                      wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model.live="deletingOpen">
        <x-slot name="title">
            {{ __('Delete ' . $category->name) }}
        </x-slot>

        <x-slot name="content">
            {{ __('To delete this category, please enter this category\'s name to verify.') }}

            <div class="mt-4"
                 x-on:confirming-delete-list.window="setTimeout(() => $refs.categoryName.focus(), 250)">
                <x-input type="text" class="mt-1 block w-3/4"
                         placeholder="{{ $category->name }}"
                         wire:model="deletingState.name"
                         wire:keydown.enter="deleteCategory"/>
                <x-input-error for="categoryName" class="mt-2"/>
            </div>

            <div class="mt-4 flex gap-2 items-center">
                <span>Would you want to delete this category's items?</span>
                <x-checkbox class="mt-1 block border-gray-400" wire:model="deletingState.deleteItems"/>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('deletingOpen')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3"
                             wire:click="deleteCategory"
                             wire:loading.attr="disabled">
                {{ __('Delete Category') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
