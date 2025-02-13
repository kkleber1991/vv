<div class="py-12">
    <!-- Modal de Limite Atingido -->
    <div x-data="{ show: @entangle('showLimitModal') }"
         x-show="show"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                 aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Limite de Anúncios Atingido
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $limitMessage }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <a href="{{ route('plans.index') }}"
                       class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:col-start-2">
                        Atualizar Plano
                    </a>
                    <button type="button"
                            @click="show = false"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:col-start-1">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ $isEditing ? 'Editar Anúncio' : 'Novo Anúncio' }}
                    </h2>
                </div>

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Formulário -->
                <form wire:submit.prevent="save" class="space-y-8">
                    <!-- Informações Básicas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome</label>
                            <input type="text" wire:model="nome" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('nome') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Idade</label>
                            <input type="number" wire:model="idade" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('idade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peso (kg)</label>
                            <input type="number" step="0.1" wire:model="peso" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('peso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
                            <select wire:model="tipo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="mulher">Mulher</option>
                                <option value="homem">Homem</option>
                                <option value="trans">Trans</option>
                            </select>
                            @error('tipo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nacionalidade</label>
                            <select wire:model="nacionalidade" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                @foreach(['Brasileira', 'Boliviana', 'Francesa', 'Italiana', 'Japonesa', 'Portuguesa', 'Cubana', 'Venezuelana', 'Outros'] as $nac)
                                    <option value="{{ $nac }}">{{ $nac }}</option>
                                @endforeach
                            </select>
                            @error('nacionalidade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">WhatsApp</label>
                            <input type="text" wire:model="whatsapp" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('whatsapp') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Anúncio -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título do Anúncio</label>
                            <input type="text" wire:model="titulo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('titulo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select wire:model="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea wire:model="descricao" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900"></textarea>
                        @error('descricao') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Valores -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor 30min</label>
                            <input type="number" step="0.01" wire:model="valor_30min" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('valor_30min') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor 1h</label>
                            <input type="number" step="0.01" wire:model="valor_1hr" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('valor_1hr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor 2h</label>
                            <input type="number" step="0.01" wire:model="valor_2hr" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('valor_2hr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor 3h</label>
                            <input type="number" step="0.01" wire:model="valor_3hr" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('valor_3hr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Horário de Atendimento -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Horário Início</label>
                            <input type="time" wire:model="horario_inicio" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('horario_inicio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Horário Fim</label>
                            <input type="time" wire:model="horario_fim" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            @error('horario_fim') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Localização -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                            <select wire:model.live="estado" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                                <option value="">Selecione um estado</option>
                                @foreach($estados as $uf => $nome)
                                    <option value="{{ $uf }}">{{ $nome }}</option>
                                @endforeach
                            </select>
                            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div wire:key="cidade-select">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cidade</label>
                            <select wire:model="cidade" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900" 
                                    {{ empty($estado) ? 'disabled' : '' }}>
                                <option value="">Selecione uma cidade</option>
                                @if(!empty($estado))
                                    @foreach($cidades as $cidadeOpcao)
                                        <option value="{{ $cidadeOpcao }}">{{ $cidadeOpcao }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('cidade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Serviços -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Serviços Oferecidos</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($servicosDisponiveis as $servico)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="servicos" value="{{ $servico }}" 
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $servico }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('servicos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Extras -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Extras</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($extrasDisponiveis as $extra)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="extras" value="{{ $extra }}"
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $extra }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('extras') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Locais de Atendimento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Locais de Atendimento</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($locaisAtendimentoDisponiveis as $local)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="locais_atendimento" value="{{ $local }}"
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $local }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('locais_atendimento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Formas de Pagamento -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Formas de Pagamento</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($formasPagamentoDisponiveis as $forma)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="formas_pagamento" value="{{ $forma }}"
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $forma }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('formas_pagamento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Línguas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Línguas</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($linguasDisponiveis as $lingua)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="linguas" value="{{ $lingua }}"
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ $lingua }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('linguas') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Atende a -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Atende a</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($atendeDisponiveis as $atende)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" wire:model="atende" value="{{ $atende }}"
                                           class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ ucfirst($atende) }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('atende') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Seção de Upload de Fotos -->
                    <div class="space-y-6">
                        <!-- Foto Principal -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Foto Principal
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                @if ($foto_principal && !$foto_principal->isPreviewable())
                                    <img src="{{ $foto_principal->temporaryUrl() }}" class="h-32 w-32 object-cover rounded-lg">
                                @elseif ($isEditing && $currentAnuncio->foto_principal)
                                    <img src="{{ asset('storage/' . $currentAnuncio->foto_principal) }}" class="h-32 w-32 object-cover rounded-lg">
                                @endif
                                
                                <input type="file" wire:model="foto_principal" class="block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-medium
                                    file:bg-primary file:text-white
                                    hover:file:cursor-pointer hover:file:bg-primary-dark">
                            </div>
                            @error('foto_principal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fotos Adicionais -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Fotos Adicionais (Máximo: {{ auth()->user()->plan->max_photos }} fotos)
                            </label>
                            <div class="mt-1">
                                <input type="file" wire:model="fotos" multiple class="block w-full text-sm text-gray-500 dark:text-gray-400
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-medium
                                    file:bg-primary file:text-white
                                    hover:file:cursor-pointer hover:file:bg-primary-dark">
                            </div>
                            @error('fotos.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                            <!-- Preview das Fotos -->
                            @if (count($fotos) > 0)
                                <div class="grid grid-cols-4 gap-4 mt-4">
                                    @foreach($fotos as $foto)
                                        @if ($foto->isPreviewable())
                                            <div class="relative">
                                                <img src="{{ $foto->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg">
                                                <button wire:click="removeFoto({{ $loop->index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <!-- Fotos Existentes (se estiver editando) -->
                            @if ($isEditing && $currentAnuncio->fotos->count() > 0)
                                <div class="grid grid-cols-4 gap-4 mt-4">
                                    @foreach($fotosAtuais as $foto)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $foto->path) }}" class="h-24 w-24 object-cover rounded-lg">
                                            <button wire:click.prevent="deleteFoto({{ $foto->id }})" 
                                                    type="button"
                                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Após o bloco de upload de fotos -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Vídeos (Máximo: {{ auth()->user()->plan->max_videos }} vídeos de até 45 segundos)
                        </label>
                        <div class="mt-1">
                            <input type="file" wire:model="videos" multiple 
                                   accept="video/mp4,video/quicktime"
                                   class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-md file:border-0
                                        file:text-sm file:font-medium
                                        file:bg-primary file:text-white
                                        hover:file:cursor-pointer hover:file:bg-primary-dark">
                        </div>
                        @error('videos.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                        <!-- Preview dos Vídeos Atuais -->
                        @if($isEditing && $videosAtuais->count() > 0)
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($videosAtuais as $video)
                            <div class="relative">
                                <video class="w-full h-32 object-cover rounded-lg" controls>
                                    <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                    Seu navegador não suporta o elemento de vídeo.
                                </video>
                                <button type="button" wire:click="deleteVideo({{ $video->id }})"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Preview dos Novos Vídeos -->
                        @if($videos && count($videos) > 0)
                        <div class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($videos as $index => $video)
                            <div class="relative">
                                <video class="w-full h-32 object-cover rounded-lg" controls>
                                    <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                                    Seu navegador não suporta o elemento de vídeo.
                                </video>
                                <button type="button" wire:click="removeVideo({{ $index }})"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Botões de Ação -->
                    <div class="flex justify-end space-x-3">
                        @if($isEditing)
                            <button type="button" wire:click="$set('isEditing', false)" 
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                Cancelar
                            </button>
                        @endif
                        <button type="submit" 
                                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                            {{ $isEditing ? 'Atualizar' : 'Criar' }} Anúncio
                        </button>
                    </div>
                </form>

                <!-- Anúncios List -->
                <div class="mt-8 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Valor</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cidade/Estado</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($anuncios as $anuncio)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                            {{ $anuncio->titulo }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $anuncio->nome }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            @if($anuncio->valor_30min)
                                                30min: R$ {{ number_format($anuncio->valor_30min, 2, ',', '.') }}<br>
                                            @endif
                                            @if($anuncio->valor_1hr)
                                                1h: R$ {{ number_format($anuncio->valor_1hr, 2, ',', '.') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold 
                                            {{ $anuncio->status === 'ativo' 
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                            {{ ucfirst($anuncio->status) }}
                                        </span>
                                        @if($anuncio->is_destaque)
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary/10 text-primary">
                                                Destaque
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $anuncio->cidade }}/{{ $anuncio->estado }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button wire:click.prevent="edit({{ $anuncio->id }})"
                                                    class="text-primary hover:text-primary-dark">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="delete({{ $anuncio->id }})"
                                                    onclick="return confirm('Tem certeza que deseja excluir este anúncio?')"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Nenhum anúncio encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginação -->
                <div class="mt-4">
                    {{ $anuncios->links() }}
                </div>
            </div>
        </div>
    </div>
</div> 