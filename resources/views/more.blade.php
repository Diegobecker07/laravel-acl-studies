<x-guest-layout>
    @include('layouts.navigation')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Post</h2>

            <div class="mt-6s">
                <h1 class="font-bold text-center">{{ $post->title }}</h1>
                <p class="text-center mt-3">
                    {{ $post->content }}
                </p>
                <h6 class="font-bold uppercase">{{ $post->author->name }}</h6>
                <a href="{{ route('index') }}" class="mt-50 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Voltar
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
