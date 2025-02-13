{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Confirmar Assinatura do Plano {{ $plan->name }}</h2>
                </div>

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Detalhes do Plano</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $plan->max_ads }} {{ Str::plural('Anúncio', $plan->max_ads) }}
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Até {{ $plan->max_photos }} fotos
                        </li>
                        <li class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $plan->max_videos }} {{ Str::plural('vídeo', $plan->max_videos) }}
                        </li>
                    </ul>
                </div>

                <div class="text-center">
                    <p class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                        Valor: R$ {{ number_format($plan->price, 2, ',', '.') }}/mês
                    </p>

                    <form action="{{ route('plans.subscribe', $plan) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150">
                            Confirmar Assinatura
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>  --}}