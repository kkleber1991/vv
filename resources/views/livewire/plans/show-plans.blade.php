<div class="py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cabeçalho -->
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Escolha seu plano</h2>
            <p class="text-lg text-gray-600 dark:text-gray-400">Encontre o plano perfeito para suas necessidades</p>
        </div>

        <!-- Grid de Planos -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($plans as $plan)
            <div class="relative">
                @if($plan->is_popular)
                <div class="absolute -top-4 left-0 right-0 text-center">
                    <span class="bg-red-600 text-white text-sm font-semibold px-4 py-1 rounded-full">
                        Mais Popular
                    </span>
                </div>
                @endif

                <div class="h-full flex flex-col rounded-2xl bg-white dark:bg-gray-800 shadow-xl {{ $plan->is_popular ? 'ring-2 ring-red-600' : '' }}">
                    <div class="p-8">
                        <h3 class="text-xl font-semibold text-red-600 mb-2">{{ $plan->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ $plan->description }}</p>
                        
                        <div class="flex items-baseline mb-8">
                            <span class="text-2xl font-semibold text-gray-900 dark:text-white">R$</span>
                            <span class="text-5xl font-bold text-gray-900 dark:text-white">{{ number_format($plan->price, 2, ',', '.') }}</span>
                            <span class="text-gray-500 dark:text-gray-400 ml-2">/mês</span>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $plan->max_ads }} {{ Str::plural('Anúncio', $plan->max_ads) }}
                            </li>
                            
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Até {{ $plan->max_photos }} fotos
                            </li>

                            @if($plan->max_videos > 0)
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $plan->max_videos }} {{ Str::plural('vídeo', $plan->max_videos) }} de 45 segundos
                            </li>
                            @endif

                            @if($plan->boosts_per_week > 0)
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $plan->boosts_per_week }} {{ Str::plural('boost', $plan->boosts_per_week) }} por semana
                            </li>
                            @endif

                            @if($plan->has_verification_seal)
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Selo de verificação
                            </li>
                            @endif

                            @if($plan->has_priority_support)
                            <li class="flex items-center text-gray-600 dark:text-gray-300">
                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Suporte prioritário
                            </li>
                            @endif
                        </ul>
                    </div>

                    <div class="p-8 mt-auto">
                        <a href="{{ route('register', ['plan' => $plan->slug]) }}"
                           class="block w-full text-center px-6 py-3 rounded-lg {{ $plan->is_popular ? 'bg-red-600 hover:bg-red-700' : 'bg-gray-800 hover:bg-gray-700' }} text-white font-semibold transition duration-150">
                            {{ $plan->price > 0 ? ($plan->is_popular ? 'Escolher Premium' : ($plan->name === 'VIP' ? 'Seja VIP' : 'Começar Agora')) : 'Começar Grátis' }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div> 