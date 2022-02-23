<div class="p-2 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-4 text-2xl">
        <div>Articulos</div>
    </div>
    <div class="mt-3">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">
                        <div class="flex items-center">ID</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Descripcion</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Precio</div>
                    </th>
                    <th class="px-4 py-2">
                        <div class="flex items-center">Cantidad</div>
                    </th>
                    <th class="px-4 py-2">
                        Status
                    </th>
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
