<x-app-layout>
    <x-slot name="header">
      <form action="{{ route('photo.index') }}" method="get">
          <button name="search" value="all" class="m-4 @if(!isset($_GET['search']) || $_GET['search'] === 'all') text-blue-400 text-lg font-bold @endif">
            すべて
          </button>
          <button name="search" value="favorite" class="m-4 @if(isset($_GET['search']) && $_GET['search'] === 'favorite') text-blue-400 text-lg font-bold @endif">
            お気に入り
          </button>
      </form>

      <div class="p-3 w-full mb-4">
        <div class="relative">
          <h5>カテゴリ―</h5>
          <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out h-48 overflow-scroll">
            @if(isset($_GET['category_id']))
            <a href="{{ route('photo.index') }}">すべて</a>
            @else
            <p class="text-green-500 font-bold">すべて</p>
            @endif

            @foreach($categories as $category)
            <div>
              @if(!isset($_GET['category_id']) || $category->id != $_GET['category_id'])
              <a href="{{ route('photo.index', ['category_id' => $category->id, 'search' => $_GET['search'] ?? 'all']) }}">{{ $category->name }}</a>
              @else
              <p class="text-green-500 font-bold">{{ $category->name }}</p>
              @endif
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl h-full sm:rounded-lg">
                @if(session('message'))
                  <div class=" text-white bg-green-400 mx-auto text-center mt-4 p-2 w-2/3 rounded ">
                    {{ session('message') }}
                  </div>
                @elseif(session('delete_message'))
                  <div class=" text-white bg-red-400 mx-auto text-center mt-4 p-2 w-2/3 rounded ">
                    {{ session('delete_message') }}
                  </div>
                @endif
                
                <section class="text-gray-600 body-font">
                  <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4">
                    @if(count($photos) === 0)
                      <div class="mx-auto text-2xl">写真がありません。</div>
                    @endif
                    @foreach($photos as $photo)
                      <div class="lg:w-1/3 md:w-1/2 md:h-1/2 sm:w-full lg:h-1/3 sm:h-full p-4 mb-16 md:mb-4">
                        <a href="{{ route('photo.show', ['photo' => $photo->id]) }}" class="w-full h-full">
                          <img class="inset-0 w-full h-full object-cover object-center border-2" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                        </a>
                        <div class="flex justify-between bg-gray-400 p-2">
                          <span class="text-black pt-1">
                            タイトル : 
                            <span class="text-lg">{{ $photo->title }}</span>
                          </span>
                          @livewire('favorite', ['photo' => $photo])
                        </div>
                      </div>
                    @endforeach
                    </div>
                  </div>
                </section>
                <button onclick="location.href='{{ route('photo.create') }}'" class="fixed right-10 bottom-10  rounded-full text-white bg-blue-400 hover:bg-blue-500 shadow-xl transform hover:scale-105 z-10">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 px-4 py-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
