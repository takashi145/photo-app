<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <section class="text-gray-600 body-font relative">
                    <form action="{{ route('photo.update', ['photo' => $photo->id]) }}" method="post" enctype="multipart/form-data" class="container px-5 py-12 mx-auto">
                      @csrf
                      @method('put')
                      <div x-data="image_preview()" class="text-center w-full mb-12">
                        <div class="mb-4 w-full h-full">
                          <div x-show="image_file" class="border-2 md:w-1/2 md:h-1/2 mx-auto">
                              <img :src="image_file">
                          </div>
                          <div x-show="!image_file" class="border-2 md:w-1/2 md:h-1/2 mx-auto">
                              <img src="{{ asset('storage/photo/'. $photo->image_name) }}">
                          </div>
                        </div>
                        <input type="file" id="image" name="image_name" x-ref="preview" @change="upload" accept="image/png,image/jpeg,image/jpg" class="ml-16">
                      </div>
                      <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <div class="flex flex-col -m-2">
                          <div class="p-2 w-full mb-4">
                            <div class="relative">
                              <label for="category" class="leading-7 text-lg text-gray-600">カテゴリ―</label>
                              <select id="category" name="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $photo->category_id) selected @endif>
                                  {{ $category->name }}
                                </option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="p-2 w-full mb-4">
                            <div class="relative">
                              <label for="title" class="leading-7 text-lg text-gray-600">タイトル</label>
                              <input type="text" id="title" name="title" value="{{ $photo->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                          </div>
                          <div class="p-2 w-full mb-8">
                            <div class="relative">
                              <label for="explanation" class="leading-7 text-lg text-gray-600">説明</label>
                              <textarea id="explanation" name="explanation" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-64 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $photo->explanation }}</textarea>
                            </div>
                          </div>
                          <div class="p-2 w-full text-center">
                            <button type="submit" class="text-white bg-indigo-500 border-0 py-3 px-24 focus:outline-none hover:bg-indigo-600 rounded text-lg">変更</button>
                          </div>
                        </div>
                      </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <script>
      const image_preview = () => {
        return {
          image_file: '',
          upload(){
            this.image_file = URL.createObjectURL(this.$refs.preview.files[0])
          }
        }
      }
    </script>
</x-app-layout>
