<x-frontend-layout>
    <div class="pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                    <!-- Anúncios em Destaque (Boosters) -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Em Destaque</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($anunciosDestaque as $anuncio)
                            <div class="bg-gradient-to-r from-primary/10 to-pink-500/10 dark:from-primary/20 dark:to-pink-500/20 rounded-xl shadow-lg overflow-hidden relative">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">
                                        DESTAQUE
                                    </span>
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                        {{ $anuncio->titulo }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ $anuncio->descricao }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-primary font-semibold">
                                            R$ {{ number_format($anuncio->valor, 2, ',', '.') }}
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $anuncio->cidade }}/{{ $anuncio->estado }}
                                        </span>
                                    </div>
                                    <div class="mt-4">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $anuncio->whatsapp) }}" 
                                           target="_blank"
                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Anúncios Normais -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Todos os Anúncios</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($anuncios as $anuncio)
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                        {{ $anuncio->titulo }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ $anuncio->descricao }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-primary font-semibold">
                                            R$ {{ number_format($anuncio->valor, 2, ',', '.') }}
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $anuncio->cidade }}/{{ $anuncio->estado }}
                                        </span>
                                    </div>
                                    <div class="mt-4">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $anuncio->whatsapp) }}" 
                                           target="_blank"
                                           class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                            </svg>
                                            WhatsApp
                                        </a>
                                    </div>
                                </div>
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