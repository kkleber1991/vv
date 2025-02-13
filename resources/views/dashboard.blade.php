<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header com Boas-vindas -->
            <div class="text-center mb-16 relative">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="h-16 w-16 bg-primary/5 rounded-full blur-xl"></div>
                </div>
                <h1 class="font-playfair text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4 relative">
                    Bem-vindo(a), <span class="text-primary italic">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    @role('acompanhante')
                    Gerencie seus anúncios e acompanhe suas métricas
                    @endrole
                    @role('cliente')
                    Encontre os melhores anúncios e acompanhantes
                    @endrole
                    @role('admin')
                    Gerencie todo o sistema e acompanhe as métricas
                    @endrole
                </p>
            </div>

            <!-- Cards de Ação Rápida -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @role('acompanhante')
                <!-- Card Meus Anúncios -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Meus Anúncios</h3>
                            <span class="p-2 bg-primary/10 rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Gerencie seus anúncios ativos e crie novos
                        </p>
                        <a href="{{ route('anuncios.index') }}" 
                           class="inline-flex items-center text-primary hover:text-primary-dark transition-colors duration-200">
                            Ver anúncios
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endrole

                @role('admin')
                <!-- Card Gestão de Usuários -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Gestão de Usuários</h3>
                            <span class="p-2 bg-primary/10 rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Administre todos os usuários do sistema
                        </p>
                        <a href="{{ route('admin.users') }}" 
                           class="inline-flex items-center text-primary hover:text-primary-dark transition-colors duration-200">
                            Gerenciar usuários
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card Gestão de Planos -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Gestão de Planos</h3>
                            <span class="p-2 bg-primary/10 rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Configure e gerencie os planos disponíveis
                        </p>
                        <a href="{{ route('admin.plans') }}" 
                           class="inline-flex items-center text-primary hover:text-primary-dark transition-colors duration-200">
                            Gerenciar planos
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card Blog -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Blog</h3>
                            <span class="p-2 bg-primary/10 rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Gerencie as postagens do blog
                        </p>
                        <a href="{{ route('admin.posts') }}" 
                           class="inline-flex items-center text-primary hover:text-primary-dark transition-colors duration-200">
                            Gerenciar posts
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endrole

                @role('cliente')
                <!-- Card Anúncios Disponíveis -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Anúncios Disponíveis</h3>
                            <span class="p-2 bg-primary/10 rounded-lg">
                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            Explore os anúncios disponíveis
                        </p>
                        <a href="{{ route('anuncios.disponiveis') }}" 
                           class="inline-flex items-center text-primary hover:text-primary-dark transition-colors duration-200">
                            Ver anúncios
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endrole
            </div>

            <!-- Decoração de Fundo -->
            <div class="absolute inset-0 -z-10 overflow-hidden">
                <div class="absolute left-[40%] top-1/4 h-64 w-64 -translate-x-1/2 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute right-[40%] bottom-1/4 h-64 w-64 translate-x-1/2 bg-primary/5 rounded-full blur-3xl"></div>
            </div>
        </div>
    </div>
</x-app-layout>
