<x-frontend-layout>
    <div class="pt-32 pb-20">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <header class="text-center mb-16 relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-16 w-16 bg-primary/5 rounded-full blur-xl"></div>
                </div>
                
                <h1 class="font-playfair text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white mb-6 relative">
                    {{ $post->title }}
                </h1>
                
                <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400 space-x-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                            {{ $post->published_at->format('d M, Y') }}
                        </time>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $post->user->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if ($post->image)
                <div class="mb-16 rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ $post->image_url }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-auto">
                </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg dark:prose-invert max-w-none prose-headings:font-playfair prose-headings:font-bold prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-a:text-primary hover:prose-a:text-primary-dark prose-img:rounded-xl">
                {!! $post->content !!}
            </div>

            <!-- Navigation -->
            <div class="mt-16 pt-8 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center px-6 py-3 rounded-full text-primary hover:text-white border-2 border-primary hover:bg-primary transition-all duration-300">
                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Voltar para o Blog
                </a>
            </div>
        </article>
    </div>
</x-frontend-layout> 