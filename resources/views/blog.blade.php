<x-guest-layout>
    @include('layouts.navigation')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
            <h2 class="text-2xl font-bold text-gray-900">Posts</h2>

            <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-y-8">
                @foreach ($posts as $post)
                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <a href="{{ route('posts.more', $post->id) }}">
                                <img src="{{ $post->image }}" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="w-full h-full object-center object-cover">
                            </a>
                        </div>
                        <div class="my-3 flex justify-between align-items-center">
                            <h3 class="mt-6 text-sm text-gray-500">
                                <a href="{{ route('posts.more', $post->id) }}">
                                    <span class="absolute inset-0"></span>
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <small>
                                {{ $post->author->name }}
                            </small>
                        </div>
                        <p class="text-base font-semibold text-gray-900">{{ substr($post->content, 0, 130) }}</p>
                        <a href="{{ route('posts.more', $post->id) }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Leia mais ...
                        </a>
                    </div>
                @endforeach
            </div>
            {{ $posts->links() }}
        </div>
    </div>
</x-guest-layout>
