<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thy Forums') }}
        </h2> --}}
    </x-slot>

    <!-- Forum Section with Full Background and Solid Padding Background -->
    <div class="py-12 min-h-screen bg-cover bg-center"
        style="background-image: url('{{ asset('images/forums_bg.png') }}');">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-200">Forum Posts</h2>
                        {{-- <a href="{{ route('forum.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Post
                        </a> --}}
                    </div>

                    <div class="space-y-6">
                        @foreach ($forums as $post)
                            <div class="border p-4 rounded-lg hover:shadow-md transition">
                                <h3 class="text-xl font-semibold mb-2 text-gray-200">{{ e($post->title) }}</h3>
                                <div class="text-gray-200 text-sm mb-2">
                                    Posted by {{ e($post->user->name) }}
                                    {{ $post->created_at }}
                                </div>
                                <p class="text-gray-200">
                                    {{ Str::limit($post->content, 200) }}
                                </p>
                            </div>
                            <div class="mt-4 flex space-x-4">
                                <form method="POST" action="{{ route('forum.destroy', $post) }}" class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
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
