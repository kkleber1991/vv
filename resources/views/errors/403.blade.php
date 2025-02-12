<x-frontend-layout>
    <div class="min-h-screen pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-center text-center">
                <!-- Ícone de Erro -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="h-32 w-32 bg-primary/5 rounded-full blur-2xl"></div>
                    </div>
                    <svg class="w-24 h-24 text-primary relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m4-6V4m0 0h2m-2 0H8m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <!-- Código de Erro -->
                <h1 class="font-playfair text-9xl font-bold text-primary mb-4">403</h1>

                <!-- Mensagem de Erro -->
                <h2 class="text-3xl font-playfair font-bold text-gray-900 dark:text-white mb-4">
                    Acesso Não Autorizado
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-8">
                    Desculpe, você não tem permissão para acessar esta página. Por favor, verifique suas credenciais ou entre em contato com o administrador.
                </p>

                <!-- Botões de Ação -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url()->previous() }}" 
                       class="inline-flex items-center px-6 py-3 rounded-full text-primary border-2 border-primary hover:bg-primary hover:text-white transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Voltar
                    </a>
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-6 py-3 rounded-full bg-primary text-white hover:bg-primary-dark transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Ir para Dashboard
                    </a>
                </div>

                <!-- Decoração de Fundo -->
                <div class="absolute inset-0 -z-10 overflow-hidden">
                    <div class="absolute left-[40%] top-1/4 h-64 w-64 -translate-x-1/2 bg-primary/5 rounded-full blur-3xl"></div>
                    <div class="absolute right-[40%] bottom-1/4 h-64 w-64 translate-x-1/2 bg-primary/5 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout> 