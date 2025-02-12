<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Gerenciar Anúncios</h2>
                    @can('criar anuncios')
                        <button wire:click="$set('isEditing', false)" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-md transition">
                            Novo Anúncio
                        </button>
                    @endcan
                </div>

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form -->
                <div class="mb-8 bg-gray-50 dark:bg-gray-900 p-6 rounded-lg">
                    <form wire:submit="save">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="titulo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                                <input type="text" wire:model="titulo" id="titulo" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="valor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Valor</label>
                                <input type="number" wire:model="valor" id="valor" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                @error('valor') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="descricao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                                <textarea wire:model="descricao" id="descricao" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary"></textarea>
                                @error('descricao') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 dark:text-gray-300">WhatsApp</label>
                                <input type="text" wire:model="whatsapp" id="whatsapp" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                @error('whatsapp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="cidade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cidade</label>
                                    <input type="text" wire:model="cidade" id="cidade" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                    @error('cidade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                                    <input type="text" wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                    @error('estado') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                                <select wire:model="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="md:col-span-2 flex justify-end space-x-3">
                                @if($isEditing)
                                    <button type="button" wire:click="$set('isEditing', false)" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        Cancelar
                                    </button>
                                @endif
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                                    {{ $isEditing ? 'Atualizar' : 'Criar' }} Anúncio
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Anúncios List -->
                <div class="overflow-x-auto">
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
                            @foreach($anuncios as $anuncio)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $anuncio->titulo }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($anuncio->descricao, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        R$ {{ number_format($anuncio->valor, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $anuncio->status === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $anuncio->status === 'ativo' ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $anuncio->cidade }}/{{ $anuncio->estado }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($anuncio->user_id === auth()->id() || auth()->user()->can('editar anuncios'))
                                            <button wire:click="edit({{ $anuncio->id }})" class="text-primary hover:text-primary-dark mr-3">Editar</button>
                                        @endif
                                        @if($anuncio->user_id === auth()->id() || auth()->user()->can('excluir anuncios'))
                                            <button wire:click="delete({{ $anuncio->id }})" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este anúncio?')">Excluir</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $anuncios->links() }}
                </div>
            </div>
        </div>
    </div>
</div> 