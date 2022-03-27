<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font overflow-hidden">
                  <div class="container px-5 py-8 mx-auto">
                    @if(session('message'))
                    <div class=" text-white bg-green-400 mx-auto text-center mt-4 p-2 w-1/3 rounded ">
                      {{ session('message') }}
                    </div>
                    @endif
                    <div class="lg:w-full mx-auto flex flex-wrap">
                      <img class="lg:w-1/3 w-2/3 mx-auto md:mt-8 lg:h-1/3 object-cover object-center rounded hover:ring-2 border-2 cursor-pointer" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-4 lg:mt-0 p-3">
                        <div class="mx-2 text-right mb-4">
                          投稿者：
                          <a href="" class="text-lg font-bold hover:underline">{{ $photo->user->name }}</a>
                        </div>
                        <h2 class="text-sm title-font text-gray-500 tracking-widest mb-2">カテゴリ</h2>
                        <h1 class="text-gray-700 text-2xl bg-gray-100 rounded title-font font-medium mb-2 p-2">{{ $photo->title}}</h1>
                        <p class="leading-relaxed bg-gray-100 rounded h-64 p-2">{{ $photo->explanation }}</p>
                        @if($photo->user->id === Auth::id())
                        <div class="flex justify-between mt-6 pb-2 border-t-2 p-2 border-gray-100">
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
            </div>
        </div>
    </div>
    <script>
      function deletion_confirmation(){
        if(confirm('本当に削除してもよろしいですか。')){
          return true;
        }
        return false
      }
    </script>
</x-app-layout>