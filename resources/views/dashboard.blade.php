<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($message)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center">
                            <p>{{ __($message) }}</p>
                            <a href="{{ route('forum.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Create New Post
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 border-b border-gray-200">
                                        <!-- Success Message -->
                                        @if (session('success'))
                                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                                role="alert">
                                                <span class="block sm:inline">{{ session('success') }}</span>
                                            </div>
                                        @endif

                                        <!-- Error Message -->
                                        @if (session('error'))
                                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                                role="alert">
                                                <span class="block sm:inline">{{ session('error') }}</span>
                                            </div>
                                        @endif

                                        <div class="flex justify-between items-center mb-6">
                                            <h2 class="text-2xl font-semibold text-gray-200">
                                                {{ __('Your Forum Posts') }}</h2>
                                            <a href="{{ route('forum.create') }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Create New Post
                                            </a>
                                        </div>

                                        <div class="space-y-6">
                                            @foreach ($forums as $post)
                                                <div class="border p-4 rounded-lg hover:shadow-md transition">
                                                    <h3 class="text-xl font-semibold mb-2 text-gray-200">
                                                        {{ $post->title }}
                                                    </h3>
                                                    <div class="text-gray-200 text-sm mb-2">
                                                        Posted by {{ $post->user->name }}
                                                        {{ $post->created_at }}
                                                    </div>
                                                    <p class="text-gray-200">
                                                        {{ Str::limit($post->content, 200) }}
                                                    </p>

                                                    <!-- Edit/Delete Buttons -->
                                                    <div class="mt-4 flex space-x-4">
                                                        <a href="{{ route('forum.edit', $post) }}"
                                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                            Edit
                                                        </a>
                                                        <form method="POST"
                                                            action="{{ route('forum.destroy', $post) }}" class="inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mt-6">
                                            {{ $forums->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
