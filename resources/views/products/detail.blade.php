<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba Nivel</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #fafafa;
        }
    </style>
<body>
    <div class="container mx-auto my-8">
        <h1 class="font-bold text-4xl | my-8">Prueba Nivel</h1>
        <div class="flex items-center justify-between | mb-3">
            <h4 class="font-semibold text-xl">{{ $product->id }}</h4>
            <a href="{{ route('product-list') }}" class="text-blue-500 hover:text-blue-700 hover:underline">
                Listado de productos
            </a>
        </div>

        <div class="bg-white border rounded | p-4">
            <div class="overflow-x-auto">
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->ean ?: 'text-gray-400' }}">ean: </p>
                    <p>{{ $product->ean }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->sku_provider ?: 'text-gray-400' }}">sku_provider: </p>
                    <p>{{ $product->sku_provider }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->name ?: 'text-gray-400' }}">name: </p>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->description ?: 'text-gray-400' }}">description: </p>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->seo_keywords ?: 'text-gray-400' }}">seo_keywords: </p>
                    <p>{{ $product->seo_keywords }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->provider_full_description ?: 'text-gray-400' }}">provider_full_description: </p>
                    <p>{{ $product->provider_full_description }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->provider_short_description ?: 'text-gray-400' }}">provider_short_description: </p>
                    <p>{{ $product->provider_short_description }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->provider_attribute_description ?: 'text-gray-400' }}">provider_attribute_description: </p>
                    <p>{{ $product->provider_attribute_description }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->provider_name ?: 'text-gray-400' }}">provider_name: </p>
                    <p>{{ $product->provider_name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->intrastat ?: 'text-gray-400' }}">intrastat: </p>
                    <p>{{ $product->intrastat }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->brand_name ?: 'text-gray-400' }}">brand_name: </p>
                    <p>{{ $product->brand_name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->brand_supplier_name ?: 'text-gray-400' }}">brand_supplier_name: </p>
                    <p>{{ $product->brand_supplier_name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_name ?: 'text-gray-400' }}">category_name: </p>
                    <p>{{ $product->category_name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_name2 ?: 'text-gray-400' }}">category_name2: </p>
                    <p>{{ $product->category_name2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_name3 ?: 'text-gray-400' }}">category_name3: </p>
                    <p>{{ $product->category_name3 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_supplier_name ?: 'text-gray-400' }}">category_supplier_name: </p>
                    <p>{{ $product->category_supplier_name }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_supplier_name2 ?: 'text-gray-400' }}">category_supplier_name2: </p>
                    <p>{{ $product->category_supplier_name2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->category_supplier_name3 ?: 'text-gray-400' }}">category_supplier_name3: </p>
                    <p>{{ $product->category_supplier_name3 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->part_number ?: 'text-gray-400' }}">part_number: </p>
                    <p>{{ $product->part_number }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->collection ?: 'text-gray-400' }}">collection: </p>
                    <p>{{ $product->collection }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->width ?: 'text-gray-400' }}">width: </p>
                    <p>{{ $product->width }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->height ?: 'text-gray-400' }}">height: </p>
                    <p>{{ $product->height }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->length ?: 'text-gray-400' }}">length: </p>
                    <p>{{ $product->length }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->weight ?: 'text-gray-400' }}">weight: </p>
                    <p>{{ $product->weight }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->width2 ?: 'text-gray-400' }}">width2: </p>
                    <p>{{ $product->width2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->height2 ?: 'text-gray-400' }}">height2: </p>
                    <p>{{ $product->height2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->length2 ?: 'text-gray-400' }}">length2: </p>
                    <p>{{ $product->length2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->weight2 ?: 'text-gray-400' }}">weight2: </p>
                    <p>{{ $product->weight2 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->width_packaging ?: 'text-gray-400' }}">width_packaging: </p>
                    <p>{{ $product->width_packaging }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->height_packaging ?: 'text-gray-400' }}">height_packaging: </p>
                    <p>{{ $product->height_packaging }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->length_packaging ?: 'text-gray-400' }}">length_packaging: </p>
                    <p>{{ $product->length_packaging }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->weight_packaging ?: 'text-gray-400' }}">weight_packaging: </p>
                    <p>{{ $product->weight_packaging }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->width_master ?: 'text-gray-400' }}">width_master: </p>
                    <p>{{ $product->width_master }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->height_master ?: 'text-gray-400' }}">height_master: </p>
                    <p>{{ $product->height_master }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->length_master ?: 'text-gray-400' }}">length_master: </p>
                    <p>{{ $product->length_master }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->weight_master ?: 'text-gray-400' }}">weight_master: </p>
                    <p>{{ $product->weight_master }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->unit_box ?: 'text-gray-400' }}">unit_box: </p>
                    <p>{{ $product->unit_box }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->unit_palet ?: 'text-gray-400' }}">unit_palet: </p>
                    <p>{{ $product->unit_palet }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->assortment ?: 'text-gray-400' }}">assortment: </p>
                    <p>{{ $product->assortment }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->min_sales_unit ?: 'text-gray-400' }}">min_sales_unit: </p>
                    <p>{{ $product->min_sales_unit }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->cbm ?: 'text-gray-400' }}">cbm: </p>
                    <p>{{ $product->cbm }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->object_type_1 ?: 'text-gray-400' }}">object_type_1: </p>
                    <p>{{ $product->object_type_1 }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->price_catalog ?: 'text-gray-400' }}">price_catalog: </p>
                    <p>{{ $product->price_catalog }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->price_wholesale ?: 'text-gray-400' }}">price_wholesale: </p>
                    <p>{{ $product->price_wholesale }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->price_retail ?: 'text-gray-400' }}">price_retail: </p>
                    <p>{{ $product->price_retail }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->price ?: 'text-gray-400' }}">price: </p>
                    <p>{{ $product->price }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->tax ?: 'text-gray-400' }}">tax: </p>
                    <p>{{ $product->tax }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->stock ?: 'text-gray-400' }}">stock: </p>
                    <p>{{ $product->stock }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->stock_catalog ?: 'text-gray-400' }}">stock_catalog: </p>
                    <p>{{ $product->stock_catalog }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->stock_to_show ?: 'text-gray-400' }}">stock_to_show: </p>
                    <p>{{ $product->stock_to_show }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->stock_available ?: 'text-gray-400' }}">stock_available: </p>
                    <p>{{ $product->stock_available }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->assortment ?: 'text-gray-400' }}">assortment: </p>
                    <p>{{ $product->assortment }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->vmd ?: 'text-gray-400' }}">vmd: </p>
                    <p>{{ $product->vmd }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->new ?: 'text-gray-400' }}">new: </p>
                    <p>{{ $product->new }}</p>
                </div>
                <div class="flex items-center space-x-2 h-6">
                    <p class="font-semibold uppercase text-gray-500 text-sm {{ $product->active ?: 'text-gray-400' }}">active: </p>
                    <p>{{ $product->active }}</p>
                </div>
            </div>

            @if ($product->eans->count() > 1)
            <h5 class="text-lg font-semibold | mt-4 | border-t pt-2">Eans</h5>
                <ul>
                    @foreach ($product->eans as $ean)
                        <li>
                            {{ $loop->iteration }} - {{ $ean->ean }}
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($product->attributes->count() > 0)
                <h5 class="text-lg font-semibold | mt-4 | border-t pt-2">Attributes</h5>
                <ul>
                    @foreach ($product->attributes as $prodAttr)
                        <li>
                            <div class="flex items-center space-x-2 h-6">
                                <p class="font-semibold uppercase text-gray-500 text-sm {{ $prodAttr->attribute->value ?: 'text-gray-400' }}">{{ $prodAttr->attribute->name }}: </p>
                                <p>{{ $prodAttr->value }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if ($product->images->count() > 0)
            <h5 class="text-lg font-semibold | mt-4 | border-t pt-2">Images</h5>
                <ul>
                    @foreach ($product->images as $image)
                        <li>
                            {{ $loop->iteration }} - {{ $image->image_path }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
</body>
</html>