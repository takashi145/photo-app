<div>
    @if($photo->user->id !== Auth::id())
    <div class="mb-8">
        <textarea wire:model.defer="comment" class="w-full h-12 mx-auto"></textarea>
        <div class="text-right">
            <button wire:click="comment({{ $photo->id }})" class="text-white bg-blue-500 py-2 px-4 rounded">コメントを送信</button>
        </div>
    </div>
    @endif
    <div class="text-xl p-2 border-b-2">コメント一覧：</div>
    <div class="mb-2 p-2 md:w-2/3 mx-auto">
        @foreach($comments as $comment)
        <div class="border-b-2 mb-2 p-2">
            <div class="flex justify-between mb-2">
                <div>ユーザ：{{ $comment->name }}</div>
                <div>コメント日：{{ $comment->pivot->updated_at }}</div>
            </div>
            <div class="bg-gray-100 p-4"> {!! nl2br(e($comment->pivot->comment)) !!}</div>
            <div class="text-right mt-1">
                <button wire:click="delete_comment({{ $comment->pivot->id }})" class="text-red-500 text-sm p-1 rounded">
                    コメントを削除
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
