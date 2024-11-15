<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Posting') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-gray-100">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-100">Create New Post</h2>

                    <form action="{{ route('forum.post') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-100">Title</label>
                            <input type="text" name="title" id="title"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>


                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-100">Content</label>
                            <textarea name="content" id="content" rows="6"
                                      class="mt-1 block w-full rounded-md border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                      required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded">
                                Create Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Additional content goes here, such as posts listing -->



</x-app-layout>
