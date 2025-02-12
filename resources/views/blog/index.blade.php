<x-frontend-layout>
    <div class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16 relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-16 w-16 bg-primary/5 rounded-full blur-xl"></div>
                </div>
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4 relative">
                    Nosso <span class="text-primary italic">Blog</span>
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Descubra histórias inspiradoras, dicas exclusivas e as últimas novidades
                </p>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-auto max-w-6xl">
                @forelse ($posts as $post)
                    <article class="group relative bg-white dark:bg-gray-800/50 backdrop-blur-sm rounded-xl shadow-sm hover:shadow-lg overflow-hidden transition-all duration-300 hover:-translate-y-1">
                        @if ($post->image)
                            <div class="relative h-48 w-full overflow-hidden">
                                <img src="{{ $post->image_url }}" 
                                     alt="{{ $post->title }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <time datetime="{{ $post->published_at->format('Y-m-d') }}" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $post->published_at->format('d M, Y') }}
                                </time>
                                <span class="mx-2">•</span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ $post->user->name }}
                                </span>
                            </div>

                            <h2 class="text-xl font-playfair font-bold text-gray-900 dark:text-white mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm line-clamp-3">
                                {{ $post->excerpt }}
                            </p>

                            <a href="{{ route('blog.show', $post->slug) }}" 
                               class="inline-flex items-center text-primary hover:text-primary-dark transition-colors text-sm">
                                <span class="border-b border-primary hover:border-primary-dark">Ler mais</span>
                                <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-20">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <p class="text-xl text-gray-600 dark:text-gray-400">Nenhum post publicado ainda.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-frontend-layout> 