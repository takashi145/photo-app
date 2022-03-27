<div>
    @if($photo->favorite_check())
        <button wire:click="unfavorite({{ $photo->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 transform hover:scale-150" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </button>
    @else
        <button wire:click="favorite({{ $photo->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-40 translate hover:scale-150" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
    <span class="text-white text-center">{{ $count }}</span>
</div>