<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Gerenciar Planos</h2>
                <button wire:click="resetForm" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                    Novo Plano
                </button>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Formulário -->
            <form wire:submit.prevent="save" class="mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome do Plano</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preço</label>
                        <input type="number" step="0.01" wire:model="price" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descrição</label>
                        <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Máximo de Anúncios</label>
                        <input type="number" wire:model="max_ads" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('max_ads') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Máximo de Fotos</label>
                        <input type="number" wire:model="max_photos" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('max_photos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Máximo de Vídeos</label>
                        <input type="number" wire:model="max_videos" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('max_videos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Boosts por Semana</label>
                        <input type="number" wire:model="boosts_per_week" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                        @error('boosts_per_week') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Boost</label>
                        <select wire:model="boost_type" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">
                            <option value="padrao">Padrão</option>
                            <option value="destacado">Destacado</option>
                            <option value="super_destaque">Super Destaque</option>
                        </select>
                        @error('boost_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="has_verification_seal" class="rounded border-gray-300 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Selo de Verificação</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" wire:model="has_priority_support" class="rounded border-gray-300 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Suporte Prioritário</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" wire:model="is_popular" class="rounded border-gray-300 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Plano Popular</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded">
                        {{ $isEditing ? 'Atualizar' : 'Criar' }} Plano
                    </button>
                </div>
            </form>

            <!-- Lista de Planos -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Planos Existentes</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Preço</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Anúncios</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fotos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Vídeos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-800">
                            @foreach($plans as $plan)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $plan->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $plan->max_ads }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $plan->max_photos }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $plan->max_videos }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button wire:click="edit({{ $plan->id }})" class="text-primary hover:text-primary-dark mr-3">Editar</button>
                                    <button wire:click="delete({{ $plan->id }})" class="text-red-600 hover:text-red-900">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 