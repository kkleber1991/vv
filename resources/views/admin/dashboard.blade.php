<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Resumo Geral -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card Usuários -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-pink-600 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total de Usuários</h3>
                            <div class="flex items-baseline">
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                                <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    +{{ $usuariosUltimos30Dias }} últimos 30 dias
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                            <span>Acompanhantes: {{ $totalAcompanhantes }}</span>
                            <span>Clientes: {{ $totalClientes }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card Anúncios -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-600 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total de Anúncios</h3>
                            <div class="flex items-baseline">
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalAnuncios }}</p>
                                <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $anunciosAtivos }} ativos
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                            <span>Em destaque: {{ $anunciosDestaque }}</span>
                            <span>Novos: +{{ $anunciosUltimos30Dias }}</span>
                        </div>
                    </div>
                </div>

                <!-- Card Planos -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-600 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Planos Ativos</h3>
                            <div class="flex items-baseline">
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $planosAtivos }}</p>
                                @if($planoMaisPopular)
                                <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $planoMaisPopular->name }} mais popular
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Distribuição de Planos</h4>
                        <div class="space-y-2">
                            @foreach($distribuicaoPlanos as $plano)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">{{ $plano['name'] }}</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $plano['users'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Card Cidades -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-600 bg-opacity-75">
                            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Top 5 Cidades</h3>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="space-y-2">
                            @foreach($anunciosPorCidade as $cidade)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">{{ $cidade->cidade }}</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $cidade->total }} anúncios</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 