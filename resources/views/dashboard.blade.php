<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="container mx-auto my-8">
                <h1 class="font-bold text-4xl | my-8">Prueba Nivel</h1>
                <div class="flex items-center justify-between | mb-3">
                    <h4 class="font-semibold text-xl">Listado Productos</h4>
                    <a href="{{ route('product-import-data') }}" class="text-blue-500 hover:text-blue-700 hover:underline">
                        Importar datos manualmente
                    </a>
                </div>

                <div class="border rounded | bg-white | overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="text-left | px-1.5 py-1 | w-48">Product ID</th>
                                <th class="text-left | px-1.5 py-1 | w-48">Sku Provider</th>
                                <th class="text-left | px-1.5 py-1 | w-48">EAN</th>
                                <th class="text-left | px-1.5 py-1"></th>
                                <th class="text-left | px-1.5 py-1 | w-12">Attributes</th>
                                <th class="text-left | px-1.5 py-1 | w-12">Images</th>
                                <th class="text-left | px-1.5 py-1 | w-12">Fuente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t | hover:bg-gray-50">
                                    <td class="px-1.5 py-1">
                                        <a href="{{ route('product-detail', $product->getId()) }}" class="text-blue-500 hover:text-blue-700 hover:underline">
                                            {{ $product->getId() }}
                                        </a>
                                    </td>
                                    <td>{{ $product->getSkuProvider() }}</td>
                                    <td>
                                        {{ $product->getEan() }}
                                        @if ($product->eans->count() > 0)
                                            <span class="text-xs">({{ $product->eans->count() }})</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->attributes->count() }}</td>
                                    <td class="text-center">{{ $product->images->count() }}</td>
                                    <td class="text-center">{{ $product->source }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
