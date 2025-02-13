<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Vitrine Virtual') }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('storage/logov.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair+display:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Swiper.js -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    </head>
    <body class="antialiased bg-gradient-to-br from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <x-base-layout>
            <div class="min-h-screen">
                <!-- Navigation -->
                <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <!-- Logo e Links Principais -->
                            <div class="flex items-center">
                                <!-- Logo -->
                                <div class="flex-shrink-0">
                                    <a href="{{ url('/') }}">
                                        <x-application-logo class="block h-9 w-auto" />
                                    </a>
                                </div>

                                <!-- Links de Navegação Principal -->
                                <div class="hidden sm:flex sm:ml-10 space-x-8">
                                    <a href="{{ route('anuncios.disponiveis') }}" 
                                        class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                        Anúncios
                                    </a>
                                    <a href="{{ route('plans.index') }}" 
                                        class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                        Planos
                                    </a>
                                    <a href="{{ route('blog.index') }}" 
                                        class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                        Blog
                                    </a>
                                </div>
                            </div>

                            <!-- Botões da Direita -->
                            <div class="hidden sm:flex sm:items-center space-x-4">
                                <!-- Theme Toggle -->
                                <x-theme-toggle />
                                
                                <!-- Botões de Autenticação -->
                                @auth
                                    <a href="{{ url('/dashboard') }}" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary transition-colors duration-200">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary transition-colors duration-200">
                                        Login
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" 
                                            class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-primary rounded-full hover:bg-primary-dark transition-all duration-200 transform hover:scale-105">
                                            Cadastre-se
                                        </a>
                                    @endif
                                @endauth
                            </div>

                            <!-- Menu Mobile (Hamburger) -->
                            <div class="flex items-center sm:hidden">
                                <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Mobile (Conteúdo) -->
                    <div class="sm:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <a href="{{ route('anuncios.disponiveis') }}" 
                                class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                                Anúncios
                            </a>
                            <a href="{{ route('plans.index') }}" 
                                class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                                Planos
                            </a>
                            <a href="{{ route('blog.index') }}" 
                                class="block pl-3 pr-4 py-2 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                                Blog
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-gray-900 text-gray-300">
                    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                            <div class="text-center md:text-left">
                                <x-application-logo class="h-12 w-auto mx-auto md:mx-0" />
                            </div>
                            <div class="text-center">
                                <p class="text-sm">&copy; {{ date('Y') }} Vitrine Virtual. Todos os direitos reservados.</p>
                            </div>
                            <div class="text-center md:text-right">
                                <div class="flex justify-center md:justify-end space-x-6">
                                    <a href="#" class="text-gray-400 hover:text-primary">
                                        <span class="sr-only">Instagram</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-gray-400 hover:text-primary">
                                        <span class="sr-only">Twitter</span>
                                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </x-base-layout>

        <!-- Adicione antes do fechamento do body -->
        <div x-data="ageVerification()" 
             x-show="showModal" 
             x-cloak 
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            
            <!-- Overlay de fundo -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <!-- Conteúdo do Modal -->
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white dark:bg-gray-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600 dark:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-xl font-semibold leading-6 text-gray-900 dark:text-white" id="modal-title">
                                    Verificação de Idade
                                </h3>
                                <div class="mt-4">
                                    <p class="text-base text-gray-600 dark:text-gray-400">
                                        Este site contém conteúdo adulto e é destinado apenas para maiores de 18 anos.
                                    </p>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Ao clicar em "Confirmar", você declara que tem 18 anos ou mais.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" 
                                @click="confirmAge()" 
                                class="inline-flex w-full justify-center rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-dark sm:ml-3 sm:w-auto">
                            Confirmar
                        </button>
                        <a href="https://google.com" 
                           class="mt-3 inline-flex w-full justify-center rounded-md bg-white dark:bg-gray-800 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 sm:mt-0 sm:w-auto">
                            Sair
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adicione antes do fechamento do body -->
        <script>
            function ageVerification() {
                return {
                    showModal: !localStorage.getItem('age_verified'),
                    confirmAge() {
                        localStorage.setItem('age_verified', 'true');
                        this.showModal = false;
                    }
                }
            }
        </script>
    </body>
</html> 