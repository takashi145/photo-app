<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl h-full sm:rounded-lg">
                @if(session('message'))
                  <div class=" text-white bg-green-400 mx-auto text-center mt-4 p-2 w-1/3 rounded ">
                    {{ session('message') }}
                  </div>
                @elseif(session('delete_messsage'))
                  <div class=" text-white bg-red-400 mx-auto text-center mt-4 p-2 w-1/3 rounded ">
                    {{ session('delete_messagemessage') }}
                  </div>
                @endif
                
                <section class="text-gray-600 body-font">
                  <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4">
                    @if(count($photos) === 0)
                      <div class="mx-auto text-2xl">画像が投稿されていません。</div>
                    @endif
                    @foreach($photos as $photo)
                      <div class="lg:w-1/3 md:w-1/2 md:h-64 sm:w-full lg:h-64 sm:h-96 p-3 hover:ring-2 hover:cursor-pointer">
                        <a  href="{{ route('photo.show', ['photo' => $photo->id]) }}" class="w-full h-full">
                          <img class="inset-0 w-full h-full object-cover object-center border-2" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                        </a>
                      </div>
                    @endforeach
                    </div>
                  </div>
                </section>
                <button onclick="location.href='{{ route('photo.create') }}'" class="fixed right-10 bottom-10  rounded-full text-white bg-blue-400 hover:bg-blue-500 shadow-xl transform hover:scale-105">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 px-4 py-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
