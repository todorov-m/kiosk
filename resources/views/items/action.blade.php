<div class="flex space-x-1 justify-around">
    <x-modalitemdel :value="$id">
        <x-slot name="trigger">
            <button class="mb-px w-9 h-9 flex items-center justify-center rounded text-red-600 hover:text-red-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>

            </button>
        </x-slot>
        <h1 class="text-2xl text-purple-700">{{$id}}</h1>
    </x-modalitemdel>
</div>
