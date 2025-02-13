<x-frontend-layout>
    <div class="pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Slots de Anúncios e Boosts -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Slot para Ads -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg h-[200px] flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">Espaço Publicitário</span>
                    </div>
                </div>

                <!-- Slots para Boosts -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg h-[200px] flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">Boost 1</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg h-[200px] flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">Boost 2</span>
                    </div>
                </div>
            </div>

            <!-- Header com Filtros -->
            <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Cidade
                        </label>
                        <select class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="">Todas as cidades</option>
                            @foreach($cidades as $cidade)
                                <option value="{{ $cidade }}">{{ $cidade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Categoria
                        </label>
                        <select class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="">Todas as categorias</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}">{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Preço
                        </label>
                        <select class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="">Qualquer preço</option>
                            <option value="0-100">Até R$ 100</option>
                            <option value="100-200">R$ 100 - R$ 200</option>
                            <option value="200-300">R$ 200 - R$ 300</option>
                            <option value="300+">Acima de R$ 300</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-md transition">
                            Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Layout Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Coluna Principal - Anúncios -->
                <div class="lg:col-span-2">
                    <!-- Anúncios em Destaque -->
                    @if($anunciosDestaque->count() > 0)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Em Destaque</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($anunciosDestaque as $anuncio)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                                <a href="{{ route('anuncios.show', $anuncio->slug) }}" class="block">
                                    <div class="relative">
                                        <!-- Badge de Destaque -->
                                        <div class="absolute top-2 right-2">
                                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">DESTAQUE</span>
                                        </div>
                                        
                                        <!-- Imagem Principal -->
                                        <div class="aspect-w-3 aspect-h-4">
                                            @if($anuncio->foto_principal)
                                                <img src="{{ asset('storage/' . $anuncio->foto_principal) }}" 
                                                     alt="{{ $anuncio->nome }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $anuncio->nome }}</h3>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                            <p>{{ $anuncio->idade }} anos • {{ $anuncio->cidade }}/{{ $anuncio->estado }}</p>
                                            <p class="font-medium text-primary">
                                                A partir de R$ {{ number_format(min(array_filter([$anuncio->valor_30min, $anuncio->valor_1hr, $anuncio->valor_2hr, $anuncio->valor_3hr])), 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Anúncios Normais -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Todos os Anúncios</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            @foreach($anuncios as $anuncio)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-1">
                                <a href="{{ route('anuncios.show', $anuncio->slug) }}" class="block">
                                    <div class="aspect-w-3 aspect-h-4">
                                        @if($anuncio->foto_principal)
                                            <img src="{{ asset('storage/' . $anuncio->foto_principal) }}" 
                                                 alt="{{ $anuncio->nome }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $anuncio->nome }}</h3>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                            <p>{{ $anuncio->idade }} anos • {{ $anuncio->cidade }}/{{ $anuncio->estado }}</p>
                                            <p class="font-medium text-primary">
                                                A partir de R$ {{ number_format(min(array_filter([$anuncio->valor_30min, $anuncio->valor_1hr, $anuncio->valor_2hr, $anuncio->valor_3hr])), 2, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <!-- Paginação -->
                        <div class="mt-8">
                            {{ $anuncios->links() }}
                        </div>
                    </div>
                </div>

                <!-- Coluna da Direita - Publicidade -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Publicidade</h3>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg h-[300px] flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">Espaço Publicitário</span>
                            </div>
                        </div>
                        <!-- Segunda publicidade -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Publicidade</h3>
                            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg h-[300px] flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">Espaço Publicitário</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout> 