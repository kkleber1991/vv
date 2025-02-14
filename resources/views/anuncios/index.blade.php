<x-frontend-layout>
    <div class="pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header com Filtros -->
            <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <form class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Estado
                        </label>
                        <select name="estado" id="estado" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-300">
                            <option value="">Selecione o estado</option>
                            @foreach($estados as $uf => $nome)
                                <option value="{{ $uf }}">{{ $nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cidade -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Cidade
                        </label>
                        <select name="cidade" id="cidade" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-300">
                            <option value="">Selecione primeiro o estado</option>
                        </select>
                    </div>

                    <!-- Tipo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Tipo
                        </label>
                        <select name="tipo" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-300">
                            <option value="">Todos os tipos</option>
                            @foreach($tipos as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Serviços -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Serviço
                        </label>
                        <select name="servico" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-300">
                            <option value="">Todos os serviços</option>
                            @foreach($servicos as $servico)
                                <option value="{{ $servico }}">{{ $servico }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Valor -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Valor
                        </label>
                        <select name="valor" class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-gray-300">
                            <option value="">Qualquer valor</option>
                            @foreach($faixasValores as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botão de Filtrar -->
                    <div class="md:col-span-5 flex justify-end">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-md transition">
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
                                                 class="w-full anuncio-foto">
                                        @else
                                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
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
                                                R$ {{ number_format(min(array_filter([$anuncio->valor_30min, $anuncio->valor_1hr, $anuncio->valor_2hr, $anuncio->valor_3hr])), 2, ',', '.') }}
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

<!-- Adicione este script para o filtro dinâmico de cidades -->
@push('scripts')
<script>
document.getElementById('estado').addEventListener('change', function() {
    const estado = this.value;
    const cidadeSelect = document.getElementById('cidade');
    
    // Limpa as opções atuais
    cidadeSelect.innerHTML = '<option value="">Selecione a cidade</option>';
    
    if (estado) {
        // Faz uma requisição para buscar as cidades do estado selecionado
        fetch(`/api/cidades/${estado}`)
            .then(response => response.json())
            .then(cidades => {
                cidades.forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade;
                    option.textContent = cidade;
                    cidadeSelect.appendChild(option);
                });
            });
    }
});
</script>
@endpush

<!-- Adicione este trecho de estilo inline ou em uma seção de estilos -->
<style>
    .anuncio-foto {
        max-height: 240px;
        object-fit: cover;
        width: 100%;
    }
</style> 