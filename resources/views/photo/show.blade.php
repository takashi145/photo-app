<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font overflow-hidden">
                  <div class="container px-2 py-8 mx-auto">
                    @if(session('message'))
                    <div class=" text-white bg-green-400 mx-auto text-center mt-4 p-2 w-1/3 rounded ">
                      {{ session('message') }}
                    </div>
                    @endif
                    <div class="mx-auto flex flex-wrap p-4">
                      <div class="w-full md:w-1/2 h-2/3 md:h-full md:mt-16 mx-auto md:pr-4">
                        <img class="rounded hover:ring-2 border-2 cursor-pointer" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                        <div class="py-2 flex justify-between">
                          <div>
                            更新日：{{ \Carbon\Carbon::create($photo->updated_at)->diffForHumans(now()) }}
                          </div>
                          @livewire('favorite', ['photo' => $photo])
                        </div>
                      </div>
                      <div class="w-fulll md:w-1/2 w-full mt-4 p-3">
                        <div class="mx-2 text-right mb-4">
                          投稿者：
                          @if($photo->user_id === Auth::id())
                            <span class="bg-green-300 p-2 rounded-full">自分</span>
                          @endif
                          <img class="inline h-8 w-8 mx-2 rounded-full object-cover" src="{{ $photo->user->profile_photo_url }}" />
                          <a href="{{ route('user_page', ['id' => $photo->user->id]) }}" class="text-lg font-bold hover:underline">{{ $photo->user->name }}</a>
                        </div>
                        <h2 class="text-sm title-font text-gray-500 tracking-widest mb-2">
                          カテゴリ: 
                          <span class="text-lg">{{ $photo->category->name}}</span>
                        </h2>
                        <h1 class="text-gray-700 text-2xl bg-gray-100 rounded title-font font-medium mb-2 p-2">{{ $photo->title}}</h1>
                        @if(!is_null($photo->explanation))
                        <p class="leading-relaxed bg-gray-100 rounded h-64 p-2">{!! nl2br(e($photo->explanation)) !!}</p>
                        @endif
                        @if($photo->user->id === Auth::id())
                        <div class="flex justify-between mt-6 pb-2 border-b-2 p-2 border-gray-100">
                          <form action="{{ route('photo.destroy', ['photo' => $photo->id]) }}" method="post" onsubmit="return deletion_confirmation()">
                            @csrf
                            @method('delete')
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded">削除</button>
                          </form>
                          <button onclick="location.href='{{ route('photo.edit', ['photo' => $photo->id]) }}'" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-6 rounded">編集</button>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                </section>
                <div class="p-2">
                  @livewire('comment-post', ['photo' => $photo])
                </div>
            </div>
        </div>
    </div>
    <script>
      function deletion_confirmation(){
        if(confirm('本当に削除してもよろしいですか。')){
          return true;
        }
        return false;
      }
    </script>
</x-app-layout>
