<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font">
                  <div class="container px-5 py-24 mx-auto">
                    <div class="flex flex-wrap -m-4">
                    @foreach($photos as $photo)
                      <div class="lg:w-1/3 md:w-1/2 sm:w-full lg:h-1/3 sm:h-full p-4 ">
                        <div class="w-full h-full hover:ring-2 hover:cursor-pointer">
                          <img class="inset-0 w-full h-full object-cover object-center border-2" src="{{ asset('storage/photo/'. $photo->image_name) }}">
                        </div>
                      </div>
                    @endforeach
                    </div>
                  </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
