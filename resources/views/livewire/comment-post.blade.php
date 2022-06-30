<div class="border-t-2">
    @if($photo->user->id !== Auth::id())
    <div class="my-8 ">
        <h3 class="text-xl p-2">〇 コメント投稿：</h3>
        <form wire:submit.prevent ="comment({{ $photo->id }})" method="post">
            @csrf
            <div class="text-center"> 
                <textarea wire:model.defer="comment" class="w-2/3 md:w-1/2 h-24" placeholder="コメントを入力してください。"></textarea>
            </div>
            @error('comment') <div class="text-center text-red-500">{{ $message }}</div> @enderror
            <div class="text-right w-2/3 md:w-1/2 mx-auto">
                <button type="submit" class="text-white bg-blue-500 py-2 px-4 rounded">コメントを送信</button>
            </div>
        </form>
    </div>
    @endif
    <div class="text-xl p-2 border-b-2">〇 コメント一覧：</div>
    <div class="mb-2 p-2 md:w-2/3 mx-auto text-gray-600">
        @if(count($users) === 0)
            <div class="text-center text-lg my-8">まだコメントがありません。</div>
        @endif
        @foreach($users as $user)
        <div class="border-b-2 mb-2 p-2">
            <div class="flex justify-between mb-2">
                <div>
                    ユーザ：
                    <img class="inline h-8 w-8 mx-2 rounded-full object-cover" src="{{ $user->profile_photo_url }}" />
                    {{ $user->name }}
                </div>
                <div>コメント日：{{ $user->pivot->updated_at }}</div>
            </div>
            <div class="bg-gray-100 p-4"> {!! nl2br(e($user->pivot->comment)) !!}</div>
            @if($user->id === Auth::id())
            <form wire:submit.prevent="delete_comment({{ $user->pivot->id }})" class="text-right mt-1">
                <button type="submit" class="text-red-500 text-sm p-1 rounded">
                    コメントを削除
                </button>
            </form>
            @endif
        </div>
        @endforeach
    </div>
</div>
