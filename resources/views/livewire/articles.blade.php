<div class="p-2 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-4 text-2xl">
        <div>Articulos</div>
    </div>
    {{ $query }}
    <div class="mt-3">
        <div class="flex justify-between">
            <div>
                <input wire:model.debounce.500ms="q" type="search" placeholder="Buscar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline placeholder-blue-400" name="">
            </div>
            <div class="mr-2">
                <input type="checkbox" class="mr-2 leading-tight" name=""  wire:model="active" />
                Solo activos?
            </div>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr>
                <th class="px-4 py-2">
                        <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                            <x-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                            <button wire:click="sortBy('name')">Descripcion</button>
                                <x-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" /> 
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                        <button wire:click="sortBy('price')">Precio</button>
                            <x-sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" /> 
                        </div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">
                        <button wire:click="sortBy('quantity')">Cantidad</button> 
                            <x-sort-icon sortField="quantity" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                        </div>
                    </th>
                    @if(!$active)
                    <th class="px-4 py-2">
                        Status
                    </th>
                    @endif
                    <th class="px-4 py-2">
                        Accion
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td class="rounded border px-4 py-2">{{ $article->id }}</td>
                        <td class="rounded border px-4 py-2">{{ $article->name }}</td>
                        <td class="rounded border px-4 py-2">{{ number_format($article->price,2) }}</td>
                        <td class="rounded border px-4 py-2">{{ $article->quantity }}</td>
                        <td class="rounded border px-4 py-2">{{ $article->status ? 'Activo':'Inactivo' }}</td>
                        <td class="rounded border px-4 py-2">
                            <x-jet-button wire:click="confirmArticleEdit( {{ $article->id }} )" class="bg-green-500 hover:bg-green-800">
                                Editar Artículo
                            </x-jet-button>
                            <x-jet-danger-button wire:click="confirmArticleDeletion ({{ $article->id }}) " wire:loading.attr="disabled">
                                {{ __('Eliminar') }}
                            </x-jet-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $articles->links() }}
    </div>

    <x-jet-confirmation-modal wire:model="confirmingArticleDeletion">
            <x-slot name="title">
                {{ __('Eliminar Artículo') }}
            </x-slot>

            <x-slot name="content">
                {{ __('¿Está seguro que desea eliminar el Artículo?') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingArticleDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteArticle ({{ $confirmingArticleDeletion }})" wire:loading.attr="disabled">
                    {{ __('Eliminar') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>

        <x-jet-dialog-modal wire:model="confirmingArticleAdd">
            <x-slot name="title">
                {{ isset( $this->article->id) ? 'Editar Artículo' : 'Crear Artículo' }}
            </x-slot>

            <x-slot name="content">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Descripción') }}" />
                        <x-jet-input id="article.name" type="text" class="mt-1 block w-full" wire:model.defer="article.name" />
                        <x-jet-input-error for="article.name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="price" value="{{ __('Precio') }}" />
                        <x-jet-input id="article.price" type="text" class="mt-1 block w-full" wire:model.defer="article.price" />
                        <x-jet-input-error for="article.price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <x-jet-label for="quantity" value="{{ __('Cantidad') }}" />
                        <x-jet-input id="article.quantity" type="text" class="mt-1 block w-full" wire:model.defer="article.quantity" />
                        <x-jet-input-error for="article.quantity" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-4 mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model.defer="article.status" name="">
                            <span class="ml-2 text-sm text-gray-600">Activo</span>

                    </label>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingArticleAdd', false)" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="saveArticle ()" wire:loading.attr="disabled">
                    {{ __('Guardar') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
</div>
