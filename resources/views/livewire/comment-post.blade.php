<div class="border-t-2">
    @if($photo->user->id !== Auth::id())
    <div class="my-8 ">
        <h3 class="text-xl p-2">〇 コメント投稿：</h3>
        <div class="text-center"> 
            <textarea wire:model.defer="comment" class="w-2/3 md:w-1/2 h-24" placeholder="コメントを入力してください。"></textarea>
        </div>
        <div class="text-right w-2/3 md:w-1/2 mx-auto">
            <button wire:click="comment({{ $photo->id }})" class="text-white bg-blue-500 py-2 px-4 rounded">コメントを送信</button>
        </div>
    </div>
    @endif
    <div class="text-xl p-2 border-b-2">〇 コメント一覧：</div>
    <div class="mb-2 p-2 md:w-2/3 mx-auto text-gray-600">
        @if(count($comments) === 0)
            <div class="text-center text-lg my-8">まだコメントがありません。</div>
        @endif
        @foreach($comments as $comment)
        <div class="border-b-2 mb-2 p-2">
            <div class="flex justify-between mb-2">
                <div>ユーザ：{{ $comment->name }}</div>
                <div>コメント日：{{ $comment->pivot->updated_at }}</div>
            </div>
            <div class="bg-gray-100 p-4"> {!! nl2br(e($comment->pivot->comment)) !!}</div>
            @if($comment->pivot->user_id === Auth::id())
            <div class="text-right mt-1">
                <button wire:click="delete_comment({{ $comment->pivot->id }})" class="text-red-500 text-sm p-1 rounded">
                    コメントを削除
                </button>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
