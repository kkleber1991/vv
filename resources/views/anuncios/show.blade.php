<x-frontend-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
            <!-- Cabeçalho do Anúncio -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $anuncio->nome }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400 space-x-4">
                    <span>{{ $anuncio->cidade }} - {{ $anuncio->estado }}</span>
                    <span>•</span>
                    <span>{{ $anuncio->idade }} anos</span>
                    <span>•</span>
                    <span>{{ $anuncio->tipo }}</span>
                </div>
            </div>

            <!-- Grid de Fotos e Informações -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                <!-- Galeria de Fotos e Vídeos -->
                <div x-data="imageGallery('{{ asset('storage/' . $anuncio->foto_principal) }}')" class="space-y-6">
                    <!-- Foto Principal -->
                    <div class="relative h-[380px] rounded-lg overflow-hidden cursor-pointer"
                        @click="$dispatch('open-lightbox', { image: currentImage })">
                        @if ($anuncio->foto_principal)
                            <img :src="currentImage" alt="{{ $anuncio->nome }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Galeria de Fotos Adicionais -->
                    @if ($anuncio->fotos->count() > 0)
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Galeria de Fotos</h3>
                                <button 
                                    @click="$dispatch('open-video-lightbox')"
                                    @if($anuncio->videos->count() == 0) disabled @endif
                                    class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-md transition 
                                           @if($anuncio->videos->count() == 0) opacity-50 cursor-not-allowed @endif">
                                    Ver vídeos
                                </button>
                            </div>
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <!-- Foto Principal como primeiro slide -->
                                    <div class="swiper-slide">
                                        <div class="relative h-[200px] rounded-lg overflow-hidden cursor-pointer"
                                            @click="setImage('{{ asset('storage/' . $anuncio->foto_principal) }}')">
                                            <img src="{{ asset('storage/' . $anuncio->foto_principal) }}"
                                                alt="Foto Principal" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                    @foreach ($anuncio->fotos as $foto)
                                        <div class="swiper-slide">
                                            <div class="relative h-[200px] rounded-lg overflow-hidden cursor-pointer"
                                                @click="setImage('{{ asset('storage/' . $foto->path) }}')">
                                                <img src="{{ asset('storage/' . $foto->path) }}"
                                                    alt="Foto {{ $loop->iteration }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    @endif

                    <!-- Descrição -->
                    @if ($anuncio->descricao)
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sobre mim</h3>
                            <div x-data="{ expanded: false }" class="relative">
                                <div x-ref="descriptionContent"
                                    :class="{ 'line-clamp-4': !expanded, 'line-clamp-none': expanded }"
                                    class="prose dark:prose-invert max-w-none line-clamp-4 overflow-hidden">
                                    {{ $anuncio->descricao }}
                                </div>
                                <button
                                    x-show="$refs.descriptionContent.scrollHeight > $refs.descriptionContent.clientHeight"
                                    @click="expanded = !expanded"
                                    class="mt-2 text-primary hover:underline focus:outline-none">
                                    <span x-text="expanded ? 'Leia menos' : 'Ler mais'"></span>
                                </button>
                            </div>
                        </div>
                    @endif

                   
                </div>

                <!-- Informações do Anúncio -->
                <div class="space-y-6">
                    <!-- Preços -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Valores</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                <span class="block text-sm text-gray-600 dark:text-gray-400">30 minutos</span>
                                <span class="block text-lg font-bold text-primary">
                                    {{ $anuncio->valor_30min ? 'R$ ' . number_format($anuncio->valor_30min, 2, ',', '.') : '----' }}
                                </span>
                            </div>
                            <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                <span class="block text-sm text-gray-600 dark:text-gray-400">1 hora</span>
                                <span class="block text-lg font-bold text-primary">
                                    {{ $anuncio->valor_1hr ? 'R$ ' . number_format($anuncio->valor_1hr, 2, ',', '.') : '----' }}
                                </span>
                            </div>
                            <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                <span class="block text-sm text-gray-600 dark:text-gray-400">2 horas</span>
                                <span class="block text-lg font-bold text-primary">
                                    {{ $anuncio->valor_2hr ? 'R$ ' . number_format($anuncio->valor_2hr, 2, ',', '.') : '----' }}
                                </span>
                            </div>
                            <div class="text-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                <span class="block text-sm text-gray-600 dark:text-gray-400">3 horas</span>
                                <span class="block text-lg font-bold text-primary">
                                    {{ $anuncio->valor_3hr ? 'R$ ' . number_format($anuncio->valor_3hr, 2, ',', '.') : '----' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Características -->
                    {{-- <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Características</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 dark:text-gray-400">Altura:</span>
                                <span class="font-medium">{{ $anuncio->altura }}cm</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600 dark:text-gray-400">Peso:</span>
                                <span class="font-medium">{{ $anuncio->peso }}kg</span>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Serviços -->
                    @if ($anuncio->servicos)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Serviços</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->servicos as $servico)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $servico }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Extras -->
                    @if ($anuncio->extras)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Extras</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->extras as $extra)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $extra }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Locais de Atendimento -->
                    @if ($anuncio->locais_atendimento)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Locais de Atendimento</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->locais_atendimento as $local)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $local }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Formas de Pagamento -->
                    @if ($anuncio->formas_pagamento)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Formas de Pagamento</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->formas_pagamento as $forma)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $forma }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Línguas -->
                    @if ($anuncio->linguas)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Línguas</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->linguas as $lingua)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ $lingua }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Atende -->
                    @if ($anuncio->atende)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atende</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($anuncio->atende as $atende)
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                                        {{ ucfirst($atende) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Botão de Contato -->
                    <div class="mt-8">
                        <a href="https://wa.me/55{{ preg_replace('/[^0-9]/', '', $anuncio->whatsapp) }}"
                            target="_blank"
                            class="block w-full text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-150">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.764-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 1.856.001 3.598.723 4.907 2.034 1.31 1.311 2.031 3.054 2.03 4.908-.001 3.825-3.113 6.938-6.937 6.938z" />
                                </svg>
                                <span>Chamar no WhatsApp</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Lightbox Modal para Fotos -->
    <div x-data="lightbox()" x-show="isOpen" x-cloak @keydown.escape.window="isOpen = false"
        @open-lightbox.window="openLightbox($event.detail.image)"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90">
        <div class="relative w-full h-full max-w-6xl mx-auto flex flex-col">
            <!-- Foto Principal -->
            <div class="flex-grow flex items-center justify-center mb-4">
                <img :src="currentImage" class="max-w-full max-h-[80vh] object-contain">
            </div>

            <!-- Swiper para miniaturas -->
            <div class="swiper lightboxThumbsSwiper h-[220px] max-w-4xl mx-auto">
                <div class="swiper-wrapper">
                    <!-- Foto Principal como miniatura -->
                    <div class="swiper-slide cursor-pointer" data-image-src="{{ asset('storage/' . $anuncio->foto_principal) }}">
                        <div class="relative h-[200px] w-[170px] rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $anuncio->foto_principal) }}"
                                alt="Foto Principal" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <!-- Fotos Adicionais como miniaturas -->
                    @foreach ($anuncio->fotos as $foto)
                        <div class="swiper-slide cursor-pointer" data-image-src="{{ asset('storage/' . $foto->path) }}">
                            <div class="relative h-[200px] w-[170px] rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $foto->path) }}"
                                    alt="Foto {{ $loop->iteration }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Botão Fechar -->
            <button @click="isOpen = false" class="absolute top-4 right-4 text-white hover:text-gray-300 z-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Lightbox para Vídeos -->
    <div 
        x-data="videoLightbox()" 
        x-show="isOpen" 
        x-cloak 
        @keydown.escape.window="isOpen = false"
        @open-video-lightbox.window="openVideoLightbox()"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-90">
        
        <!-- Modal para quando não há vídeos -->
        <div 
            x-show="!hasVideos" 
            x-cloak 
            class="bg-white dark:bg-gray-800 rounded-lg p-8 max-w-md text-center">
            <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Sem Vídeos</h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Este anúncio não possui vídeos disponíveis no momento.
            </p>
            <button 
                @click="isOpen = false" 
                class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-lg transition">
                Fechar
            </button>
        </div>

        <!-- Conteúdo existente do lightbox de vídeos (mostrado apenas se houver vídeos) -->
        <div x-show="hasVideos" class="relative w-full h-full max-w-6xl mx-auto flex flex-col">
            <!-- Vídeo Principal -->
            <div class="flex-grow flex items-center justify-center mb-4">
                <video id="mainVideoPlayer" controls class="max-w-full max-h-[80vh] object-contain">
                    <source src="" type="video/mp4">
                    Seu navegador não suporta o elemento de vídeo.
                </video>
            </div>

            <!-- Swiper para o Lightbox de Vídeos -->
            <div class="swiper videoLightboxSwiper h-[220px] max-w-4xl mx-auto">
                <div class="swiper-wrapper">
                    @foreach ($anuncio->videos as $video)
                        <div class="swiper-slide cursor-pointer" data-video-src="{{ asset('storage/' . $video->path) }}">
                            <div class="relative h-[200px] w-[170px] rounded-lg overflow-hidden">
                                <video class="w-full h-full object-cover video-thumbnail">
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                </video>
                                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Botão Fechar -->
            <button 
                @click="isOpen = false" 
                class="absolute top-4 right-4 text-white hover:text-gray-300 z-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Script para o Lightbox -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicialização do Swiper para miniaturas
            const thumbsSwiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });

            // Inicialização do Swiper para miniaturas do lightbox de fotos
            const lightboxThumbsSwiper = new Swiper(".lightboxThumbsSwiper", {
                slidesPerView: 'auto',
                spaceBetween: 10,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                }
            });

            // Inicialização do Swiper para o lightbox de vídeos
            const videoLightboxSwiper = new Swiper(".videoLightboxSwiper", {
                slidesPerView: 'auto',
                spaceBetween: 10,
                loop: false,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: {
                        slidesPerView: 3,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
            });
        });

        // Função Alpine.js para gerenciar a galeria de fotos
        function imageGallery(initialImage) {
            return {
                currentImage: initialImage,
                setImage(url) {
                    this.currentImage = url;
                }
            }
        }

        // Função Alpine.js para o lightbox de fotos
        function lightbox() {
            return {
                isOpen: false,
                currentImage: '',
                swiper: null,
                openLightbox(imageUrl) {
                    this.isOpen = true;
                    this.currentImage = imageUrl;
                    
                    // Aguarda o Swiper ser inicializado
                    setTimeout(() => {
                        this.swiper = document.querySelector('.lightboxThumbsSwiper').swiper;
                        const thumbnails = document.querySelectorAll('.lightboxThumbsSwiper .swiper-slide');
                        
                        // Encontra o índice da imagem atual
                        const currentIndex = Array.from(thumbnails).findIndex(
                            thumb => thumb.getAttribute('data-image-src') === imageUrl
                        );
                        
                        // Move o Swiper para o slide correto
                        if (currentIndex !== -1) {
                            this.swiper.slideTo(currentIndex);
                        }

                        // Remove eventos anteriores para evitar duplicação
                        this.swiper.off('slideChange');
                        
                        // Adiciona o evento de slideChange
                        this.swiper.on('slideChange', () => {
                            const activeSlide = thumbnails[this.swiper.realIndex];
                            if (activeSlide) {
                                this.currentImage = activeSlide.getAttribute('data-image-src');
                            }
                        });

                        // Adiciona eventos de navegação por teclado
                        document.addEventListener('keydown', (e) => {
                            if (this.isOpen) {
                                if (e.key === 'ArrowRight') {
                                    this.swiper.slideNext();
                                } else if (e.key === 'ArrowLeft') {
                                    this.swiper.slidePrev();
                                }
                            }
                        });

                        // Adiciona eventos de clique nas miniaturas
                        thumbnails.forEach(thumbnail => {
                            thumbnail.addEventListener('click', () => {
                                const imageSrc = thumbnail.getAttribute('data-image-src');
                                this.currentImage = imageSrc;
                                
                                // Encontra o índice da miniatura clicada
                                const index = Array.from(thumbnails).indexOf(thumbnail);
                                if (index !== -1) {
                                    this.swiper.slideTo(index);
                                }
                            });
                        });
                    }, 100);
                }
            }
        }

        // Função Alpine.js para o lightbox de vídeos
        function videoLightbox() {
            return {
                isOpen: false,
                currentVideoIndex: 0,
                swiper: null,
                hasVideos: false,
                openVideoLightbox() {
                    const thumbnails = document.querySelectorAll('.videoLightboxSwiper .swiper-slide');
                    
                    // Verifica se há vídeos disponíveis
                    this.hasVideos = thumbnails.length > 0;
                    this.isOpen = true;
                    
                    // Se não houver vídeos, para a execução aqui
                    if (!this.hasVideos) {
                        return;
                    }
                    
                    // Aguarda o Swiper ser inicializado
                    this.$nextTick(() => {
                        const mainVideoPlayer = document.getElementById('mainVideoPlayer');
                        this.swiper = document.querySelector('.videoLightboxSwiper').swiper;
                        const thumbnails = document.querySelectorAll('.videoLightboxSwiper .swiper-slide');
                        
                        // Função para trocar o vídeo
                        const changeVideo = (index) => {
                            if (index >= 0 && index < thumbnails.length) {
                                this.currentVideoIndex = index;
                                const videoSlide = thumbnails[index];
                                const videoSrc = videoSlide.getAttribute('data-video-src');
                                
                                mainVideoPlayer.querySelector('source').src = videoSrc;
                                mainVideoPlayer.load();
                                mainVideoPlayer.play();
                                
                                // Move o Swiper para o slide correto
                                this.swiper.slideTo(index);
                            }
                        };

                        // Seleciona o primeiro vídeo por padrão
                        changeVideo(0);

                        // Remove eventos anteriores para evitar duplicação
                        this.swiper.off('slideChange');
                        
                        // Adiciona o evento de slideChange
                        this.swiper.on('slideChange', () => {
                            changeVideo(this.swiper.realIndex);
                        });

                        // Adiciona eventos de navegação por teclado
                        const keydownHandler = (e) => {
                            if (this.isOpen) {
                                if (e.key === 'ArrowRight') {
                                    changeVideo(Math.min(this.currentVideoIndex + 1, thumbnails.length - 1));
                                } else if (e.key === 'ArrowLeft') {
                                    changeVideo(Math.max(this.currentVideoIndex - 1, 0));
                                }
                            }
                        };
                        document.addEventListener('keydown', keydownHandler);

                        // Adiciona eventos de clique nas miniaturas
                        thumbnails.forEach((thumbnail, index) => {
                            thumbnail.addEventListener('click', () => {
                                changeVideo(index);
                            });
                        });

                        // Limpa os eventos quando o lightbox fecha
                        const cleanup = () => {
                            document.removeEventListener('keydown', keydownHandler);
                        };

                        // Adiciona um observador para limpar os eventos quando o lightbox fechar
                        const observer = new MutationObserver((mutations) => {
                            mutations.forEach((mutation) => {
                                if (mutation.type === 'attributes' && 
                                    mutation.attributeName === 'x-cloak' && 
                                    !this.isOpen) {
                                    cleanup();
                                    observer.disconnect();
                                }
                            });
                        });

                        observer.observe(document.querySelector('[x-data="videoLightbox()"]'), {
                            attributes: true
                        });
                    });
                }
            }
        }
    </script>

    <style>
        .swiper {
            width: 100%;
            padding-bottom: 40px;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #ef4444;
            transform: scale(0.7);
            /* Reduz o tamanho das setas de navegação */
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.5rem;
            /* Reduz o tamanho do ícone da seta */
        }

        .swiper-slide {
            opacity: 0.6;
            transition: opacity 0.3s ease;
            height: 200px !important;
            /* Força a altura do slide */
        }

        .swiper-slide:hover {
            opacity: 1;
        }

        .swiper-slide-active {
            opacity: 1;
        }

        /* Ajusta o espaçamento vertical do swiper */
        .swiper-container {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        /* Estilos específicos para o lightbox */
        .lightboxSwiper {
            --swiper-navigation-color: #fff;
            --swiper-navigation-size: 44px;
        }

        .lightboxSwiper .swiper-button-next,
        .lightboxSwiper .swiper-button-prev {
            color: white;
            transform: scale(1);
        }

        .lightboxSwiper .swiper-slide {
            height: 100vh !important;
            opacity: 1;
        }

        /* Ajuste para telas menores */
        @media (max-width: 640px) {

            .lightboxSwiper .swiper-button-next,
            .lightboxSwiper .swiper-button-prev {
                transform: scale(0.7);
            }
        }

        /* Estilos específicos para o lightbox de vídeos */
        .videoLightboxSwiper {
            --swiper-navigation-color: #fff;
            --swiper-navigation-size: 44px;
            --swiper-pagination-color: #fff;
        }

        .videoLightboxSwiper .swiper-slide {
            width: 170px !important;
            height: 200px !important;
        }

        .videoLightboxSwiper .swiper-slide video {
            width: 170px;
            height: 200px;
            object-fit: cover;
        }

        .videoLightboxSwiper .swiper-slide .video-thumbnail {
            position: relative;
            width: 170px;
            height: 200px;
        }

        /* Ajuste para telas menores */
        @media (max-width: 640px) {
            .videoLightboxSwiper .swiper-button-next,
            .videoLightboxSwiper .swiper-button-prev {
                transform: scale(0.7);
            }
        }

        /* Estilos para miniaturas do lightbox de fotos */
        .lightboxThumbsSwiper {
            --swiper-navigation-color: #fff;
            --swiper-navigation-size: 44px;
        }

        .lightboxThumbsSwiper .swiper-slide {
            width: 170px !important;
            height: 200px !important;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .lightboxThumbsSwiper .swiper-slide:hover,
        .lightboxThumbsSwiper .swiper-slide-active {
            opacity: 1;
        }

        .lightboxThumbsSwiper .swiper-slide img {
            width: 170px;
            height: 200px;
            object-fit: cover;
        }

        /* Estilos compartilhados para navegação */
        .lightboxThumbsSwiper .swiper-button-next,
        .lightboxThumbsSwiper .swiper-button-prev,
        .videoLightboxSwiper .swiper-button-next,
        .videoLightboxSwiper .swiper-button-prev {
            color: white;
            transform: scale(0.7);
        }

        @media (max-width: 640px) {
            .lightboxThumbsSwiper .swiper-button-next,
            .lightboxThumbsSwiper .swiper-button-prev,
            .videoLightboxSwiper .swiper-button-next,
            .videoLightboxSwiper .swiper-button-prev {
                transform: scale(0.5);
            }
        }

        /* Adicione estes estilos para melhorar a transição entre as imagens */
        .lightbox-image-transition {
            transition: opacity 0.3s ease-in-out;
        }

        .lightbox-image-transition.fade-out {
            opacity: 0;
        }

        .lightbox-image-transition.fade-in {
            opacity: 1;
        }
    </style>
</x-frontend-layout>
