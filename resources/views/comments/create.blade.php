<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('comment.update', isset($comment->id) ? $comment->id : '') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="space-y-8 divide-y divide-gray-200">
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                <div class="sm:col-span-6">
                                    <label for="content" class="block text-sm font-medium text-gray-700">
                                        comment
                                    </label>
                                    <div class="mt-1">
                                        <textarea id="comment" name="comment" rows="10" class="{{ $errors->has('comment') ? 'text-red-900 border-red-300 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500' }} shadow-sm block w-full sm:text-sm border-gray-300 rounded-md">{{ old('comment') ?? $comment->comment ?? '' }}</textarea>
                                    </div>
                                    @error('comment')
                                    <p class="mt-2 text-sm text-red-600" id="content-error">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
