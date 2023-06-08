@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div class="text-center w-full">
        <h1 class="text-white mb-10">Create a Community</h1>
    </div>
    <div class="w-full sm:w-1/2">
        <form class="space-y-6" method="POST" action="{{ route('communities.store') }}">
            @csrf
            <div class="space-y-5">
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label for="name" class="mb-2 sm:mb-0 text-white sm:w-32">Name:</label>
                    <input type="text" id="name" name="name" class="p-2 rounded border border-gray-300 bg-gray-100 text-gray-900 dark:border-white dark:bg-gray-800 dark:text-black w-full" required>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center">
                    <label for="description" class="mb-2 sm:mb-0 text-white sm:w-32">Description:</label>
                    <textarea id="description" name="description" class="p-2 h-32 rounded border border-gray-300 bg-gray-100 text-gray-900 dark:border-white dark:bg-gray-800 dark:text-black w-full" required></textarea>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded uppercase transition duration-200 ease-in-out hover:bg-red-600">Create</button>
        </form>
    </div>
</div>
@endsection
