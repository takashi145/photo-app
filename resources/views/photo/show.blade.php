<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font overflow-hidden">
                  <div class="container px-5 py-8 mx-auto">
                    <div class="lg:w-full mx-auto flex flex-wrap">
                      <img class="lg:w-1/2 w-full lg:h-auto md:h-96 object-cover object-center rounded hover:ring-2 cursor-pointer" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-4 lg:mt-0 p-3">
                        <div class="mx-2 text-right">
                          投稿者：
                          <a href="" class="text-lg font-bold hover:underline">{{ $photo->user->name }}</a>
                        </div>
                        <h2 class="text-sm title-font text-gray-500 tracking-widest mb-2">カテゴリ</h2>
                        <h1 class="text-gray-700 text-2xl bg-gray-100 rounded title-font font-medium mb-2 p-2">{{ $photo->title}}</h1>
                        <p class="leading-relaxed bg-gray-100 rounded h-64 p-2">{{ $photo->explanation }}</p>
                        <!-- <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                          
                        </div> -->
                      </div>
                    </div>
                  </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
