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
                        <td class="rounded border px-4 py-2">Editar/Eliminar</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
