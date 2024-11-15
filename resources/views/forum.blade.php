<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thy Forums') }}
        </h2>
    </x-slot>

    <!-- Floating Button for "Make a Post" -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-200" >Forum Posts</h2>
                        {{-- <a href="{{ route('forum.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Post
                        </a> --}}
                    </div>

                    <div class="space-y-6">
                        @foreach($forums as $post)
                            <div class="border p-4 rounded-lg hover:shadow-md transition">
                                    <h3 class="text-xl font-semibold mb-2 text-gray-200">{{ $post->title }}</h3>
                                    <div class="text-gray-200 text-sm mb-2">
                                        Posted by {{ $post->user->name }}
                                        {{ $post->created_at }}
                                    </div>
                                    <p class="text-gray-200">
                                        {{ Str::limit($post->content, 200) }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        {{ $forums->links() }}
                    </div>{{-- Pagination Purposes --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Additional content goes here, such as posts listing -->


</x-app-layout>
