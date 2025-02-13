<x-frontend-layout>
    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute inset-0 bg-[url('/public/storage/bg-pattern.png')] opacity-30 dark:opacity-10"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="font-playfair text-5xl md:text-7xl font-bold text-gray-900 dark:text-white mb-8">
                    Descubra o <span class="text-primary italic">Extraordinário</span>
                </h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300 sm:mt-5">
                    Uma experiência única de encontros especiais, onde elegância e discrição se encontram em perfeita harmonia.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-white bg-primary hover:bg-primary-dark transition duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-primary/50">
                        Comece sua jornada
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium rounded-full text-primary bg-white dark:bg-gray-800 border-2 border-primary hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300 ease-in-out transform hover:scale-105">
                        Acessar conta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="py-24 bg-gray-400/10 dark:bg-gray-800/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="font-playfair text-4xl font-bold text-gray-900 dark:text-white">
                    Por que nos escolher?
                </h2>
                <div class="mt-2 h-1 w-20 bg-primary mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-pink-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative p-8 bg-white dark:bg-gray-900 ring-1 ring-gray-900/5 dark:ring-gray-800 rounded-lg leading-none flex items-top justify-start space-x-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Privacidade Garantida</h3>
                            <p class="text-gray-600 dark:text-gray-400">Sua discrição é nossa prioridade. Todos os dados são criptografados e protegidos.</p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-pink-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative p-8 bg-white dark:bg-gray-900 ring-1 ring-gray-900/5 dark:ring-gray-800 rounded-lg leading-none flex items-top justify-start space-x-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Experiências Premium</h3>
                            <p class="text-gray-600 dark:text-gray-400">Curadoria exclusiva de perfis verificados e experiências únicas.</p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-pink-600 rounded-lg blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative p-8 bg-white dark:bg-gray-900 ring-1 ring-gray-900/5 dark:ring-gray-800 rounded-lg leading-none flex items-top justify-start space-x-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary/10 text-primary">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Suporte 24/7</h3>
                            <p class="text-gray-600 dark:text-gray-400">Assistência personalizada a qualquer momento que precisar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Planos -->
    <section class="antialiased pt-24 bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="font-playfair text-4xl font-bold text-gray-900 dark:text-white">
                    Escolha o plano ideal para você
                </h2>
                <p class="mt-4 text-xl text-gray-400">
                    Temos opções para todos os perfis, desde iniciantes até profissionais.
                </p>
            </div>

            <!-- Componente de Planos -->
            @livewire('plans.show-plans')
        </div>
    </section>
</x-frontend-layout>
