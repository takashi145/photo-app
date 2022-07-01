<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($user->id === Auth::id())
                    <h2 class="p-4">マイページ</h2>
                @else
                    <h2 class="p-4">{{ $user->name }}のユーザーページ</h2>
                @endif
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-8 mx-auto flex flex-col">
                        <div>
                            <div class="flex flex-col md:flex-row mt-2">
                                <div class="md:w-1/3 text-center sm:py-8">
                                    <div class="w-40 h-40 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                                        <img src="{{ $user->profile_photo_url }}" class="rounded-full w-full h-full">
                                    </div>
                                    <div class="flex flex-col items-center text-center justify-center">
                                        <h2 class="font-medium title-font mt-4 text-gray-900 text-lg mb-3">{{ $user->name }}</h2>
                                        <p class="text-base">投稿数：{{ count($user->photos) }}</p>
                                        @if($user->id === Auth::id())
                                        <a href="{{ route('profile.show') }}" class="text-lg underline m-2 text-gray-600 hover:text-gray-900">プロフィールの編集</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:pl-32 md:w-1/2 sm:pl-8 sm:py-8 md:p-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">
                                    <h3 class="text-xl bg-blue-200 rounded p-2">投稿した写真一覧</h3>
                                    @if(count($user->photos) === 0)
                                        <div class="text-lg text-center text-gray-800 mt-8">
                                            写真がありません。
                                        </div>
                                    @endif
                                    @foreach($user->photos as $photo)
                                        <div class="my-8 p-2">
                                            <button onclick="location.href='{{ route('photo.show', ['photo' => $photo->id]) }}'" class="border-2 hover:ring-2 cursor-pointer">
                                                <img src="{{ asset('storage/photo/'. $photo->image_name) }}">
                                            </button>
                                            <div class="flex justify-between">
                                                <div>
                                                    投稿日：{{ \Carbon\Carbon::create($photo->updated_at)->diffForHumans(now()) }}<br>
                                                    タイトル：{{ $photo->title }}
                                                </div>
                                                @livewire('favorite', ['photo' => $photo])
                                            </div>
                                        </div>
                    
                                    @endforeach
                                </div>
                            </div>
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
