<div class="flex flex-row">
    @if($photo->favorite_check())
    <form wire:submit.prevent="unfavorite">
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 transform hover:scale-150" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </button>
    </form>
    @else
    <form wire:submit.prevent="favorite">
        <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 translate hover:scale-150" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </button>
    </form>
    @endif
    <span class="text-black text-center mx-2 mt-2">{{ $count }}</span>
</div>
