<?php

namespace App\Custom;

use App\Events\ProductUpdateEvent;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductEan;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductData
{
    public function importData()
    {
        // json
        $this->importJson();

        // xml
        $this->importXml();

        // xlsx
        $this->importXlsx();
    }

    public function importJson()
    {
        $origin_json = file_get_contents(public_path('catalog (3).json'));
        $source = json_decode($origin_json, true);

        if (count($source['Data']) > 0) {
            foreach ($source['Data'] as $data) {
                $product_id = 'AL-' . substr($data['Ean'], 6, 6);

                $eansArray = explode(',', $data['Ean']);

                $dataModel = array();
                $dataModel = [
                    'id'                            => $product_id,
                    'sku_provider'                  => $data['Sku_Provider'],
                    'ean'                           => $eansArray[0],
                    'provider_full_description'     => $data['Provider_Full_Description'],
                    'provider_name'                 => $data['Provider_Name'],
                    'intrastat'                     => isset($data['Intrastat']) ? $data['Intrastat'] : null,
                    'brand_supplier_name'           => $data['Brand_Supplier_Name'],
                    'category_supplier_name'        => $data['Category_Supplier_Name'],
                    'width_packaging'               => $data['Width_Packaging'],
                    'height_packaging'              => $data['Height_Packaging'],
                    'length_packaging'              => $data['Length_Packaging'],
                    'weight_packaging'              => $data['Weight_Packaging'],
                    'new'                           => $data['New'] ? 1 : 0,
                    'active'                        => $data['Active'] ? 1 : 0,
                    'source'                        => 'json'
                ];

                $attributesArray = array();
                if (isset($data['Attributes'])) {
                    foreach ($data['Attributes'] as $dataAttribue) {
                        $attributesArray[] = [
                            'attribute_id'          => $dataAttribue['Attribute_ID'],
                            'attribute_name'        => $dataAttribue['Attribute_Name'],
                            'attribute_value'       => $dataAttribue['Attribute_Value'],
                        ];
                    }
                }

                $imagesArray = array();
                if (isset($data['Images'])) {
                    foreach ($data['Images'] as $dataImage) {
                        $imagesArray[] = [
                            'path'                  => $dataImage,
                        ];
                    }
                }

                $product = Product::find($product_id);

                if (!$product) {
                    $product = $this->createProduct($dataModel, $eansArray, $attributesArray, $imagesArray);
                } else {
                    $product = $this->updateProduct($product, $dataModel, $attributesArray);
                }
            }
        }
    }

    public function importXml()
    {
        $origin_xml = file_get_contents(public_path('Articulos (2).xml'));
        $xmlString = simplexml_load_string($origin_xml);
        $json = json_encode($xmlString);
        $source = json_decode($json, true);

        if(count($source['Articulo']) > 0){
            foreach ($source['Articulo'] as $data) {
                $eansArray = explode(',', $data['CodigoBarras']);

                $dataModel = array();
                $dataModel = [
                    'id'                            => $data['Codigo'],
                    'provider_name'                 => $data['Descripcion'],
                    'ean'                           => $eansArray[0],
                    'price'                         => $data['Precio'],
                    'price_catalog'                 => $data['PrecioBase'],
                    'assortment'                    => $data['Surtido'] ?: null,
                    'stock'                         => $data['Cantidad'],
                    'stock_catalog'                 => $data['StockReal'],
                    'stock_to_show'                 => $data['StockTeorico'],
                    'stock_available'               => $data['StockDisponible'],
                    'vmd'                           => $data['VMD'],
                    'source'                        => 'xml'
                ];

                $product = Product::find($data['Codigo']);

                if (!$product) {
                    $product = $this->createProduct($dataModel, $eansArray, null, null);
                } else {
                    $product = $this->updateProduct($product, $dataModel, null);
                }
            }
        }
    }

    public function importXlsx()
    {
        $source = public_path('Productos (3).xlsx');

        Excel::import(new ProductImport, $source);
    }

    public function createProduct(Array $data, Array $eans = null, Array $attributes = null, Array $images= null)
    {
        $product = Product::create($data);

        foreach ($eans as $ean) {
            ProductEan::create([
                'product_id'    => $product->id,
                'ean'           => $ean
            ]);
        }

        if ($attributes) {
            foreach ($attributes as $attribute) {
                $attr = Attribute::where('name', $attribute['attribute_name'])->first();
                if (!$attr) {
                    $attr = Attribute::create([
                        'id'            => isset($attribute['attribute_id']) ? $attribute['attribute_id'] : null,
                        'lang_id'       => 1,
                        'name'          => $attribute['attribute_name']
                    ]);
                }
                ProductAttribute::create([
                    'product_id'        => $product->id,
                    'attribute_id'      => $attr->id,
                    'value'             => $attribute['attribute_value'],
                ]);
            }
        }

        if ($images) {
            foreach ($images as $image) {
                ProductImage::create([
                    'product_id'        => $product->id,
                    'image_path'        => $image['path'],
                ]);
            }
        }
    }

    public function UpdateProduct(Product $product, Array $data, Array $attributes= null)
    {
        $product->fill($data);

        if ($changes = $this->checkProductChanges($product)) {
            $product->update();
            event(new ProductUpdateEvent($product, $changes));
        }

        if ($attributes) {
            if ($changes = $this->checkProductAttributesChanges($product, $attributes)) {
                //update ProductAttribute
                foreach ($attributes as $attribute) {
                    $attributeId = Attribute::where('name', $attribute['attribute_name'])->first()->id;
                    $productAttribute = ProductAttribute::where('product_id', $product->id)->where('attribute_id', $attributeId)->first();
                    if ($productAttribute) {
                        $productAttribute->value = $attribute['attribute_value'];
                        $productAttribute->save();
                    }
                }
                event(new ProductUpdateEvent($product, $changes));
            }
        }
    }

    public function checkProductChanges(Product $product)
    {
        $data_changes = array();

        if ($product->id != $product->getOriginal('id')) {
            array_push($data_changes, [
                'field'     => 'id',
                'old_value' => $product->getOriginal('id'),
                'new_value' => $product->id
            ]);
        }
        if ($product->ean != $product->getOriginal('ean')) {
            array_push($data_changes, [
                'field'     => 'ean',
                'old_value' => $product->getOriginal('ean'),
                'new_value' => $product->ean
            ]);
        }
        if ($product->sku_provider != $product->getOriginal('sku_provider')) {
            array_push($data_changes, [
                'field'     => 'sku_provider',
                'old_value' => $product->getOriginal('sku_provider'),
                'new_value' => $product->sku_provider
            ]);
        }
        if ($product->name != $product->getOriginal('name')) {
            array_push($data_changes, [
                'field'     => 'name',
                'old_value' => $product->getOriginal('name'),
                'new_value' => $product->name
            ]);
        }
        if ($product->description != $product->getOriginal('description')) {
            array_push($data_changes, [
                'field'     => 'description',
                'old_value' => $product->getOriginal('description'),
                'new_value' => $product->description
            ]);
        }
        if ($product->seo_keywords != $product->getOriginal('seo_keywords')) {
            array_push($data_changes, [
                'field'     => 'seo_keywords',
                'old_value' => $product->getOriginal('seo_keywords'),
                'new_value' => $product->seo_keywords
            ]);
        }
        if ($product->provider_full_description != $product->getOriginal('provider_full_description')) {
            array_push($data_changes, [
                'field'     => 'provider_full_description',
                'old_value' => $product->getOriginal('provider_full_description'),
                'new_value' => $product->provider_full_description
            ]);
        }
        if ($product->provider_short_description != $product->getOriginal('provider_short_description')) {
            array_push($data_changes, [
                'field'     => 'provider_short_description',
                'old_value' => $product->getOriginal('provider_short_description'),
                'new_value' => $product->provider_short_description
            ]);
        }
        if ($product->provider_attribute_description != $product->getOriginal('provider_attribute_description')) {
            array_push($data_changes, [
                'field'     => 'provider_attribute_description',
                'old_value' => $product->getOriginal('provider_attribute_description'),
                'new_value' => $product->provider_attribute_description
            ]);
        }
        if ($product->provider_name != $product->getOriginal('provider_name')) {
            array_push($data_changes, [
                'field'     => 'provider_name',
                'old_value' => $product->getOriginal('provider_name'),
                'new_value' => $product->provider_name
            ]);
        }
        if ($product->intrastat != $product->getOriginal('intrastat')) {
            array_push($data_changes, [
                'field'     => 'intrastat',
                'old_value' => $product->getOriginal('intrastat'),
                'new_value' => $product->intrastat
            ]);
        }
        if ($product->brand_name != $product->getOriginal('brand_name')) {
            array_push($data_changes, [
                'field'     => 'brand_name',
                'old_value' => $product->getOriginal('brand_name'),
                'new_value' => $product->brand_name
            ]);
        }
        if ($product->brand_supplier_name != $product->getOriginal('brand_supplier_name')) {
            array_push($data_changes, [
                'field'     => 'brand_supplier_name',
                'old_value' => $product->getOriginal('brand_supplier_name'),
                'new_value' => $product->brand_supplier_name
            ]);
        }
        if ($product->category_name != $product->getOriginal('category_name')) {
            array_push($data_changes, [
                'field'     => 'category_name',
                'old_value' => $product->getOriginal('category_name'),
                'new_value' => $product->category_name
            ]);
        }
        if ($product->category_name2 != $product->getOriginal('category_name2')) {
            array_push($data_changes, [
                'field'     => 'category_name2',
                'old_value' => $product->getOriginal('category_name2'),
                'new_value' => $product->category_name2
            ]);
        }
        if ($product->category_name3 != $product->getOriginal('category_name3')) {
            array_push($data_changes, [
                'field'     => 'category_name3',
                'old_value' => $product->getOriginal('category_name3'),
                'new_value' => $product->category_name3
            ]);
        }
        if ($product->category_supplier_name != $product->getOriginal('category_supplier_name')) {
            array_push($data_changes, [
                'field'     => 'category_supplier_name',
                'old_value' => $product->getOriginal('category_supplier_name'),
                'new_value' => $product->category_supplier_name
            ]);
        }
        if ($product->category_supplier_name2 != $product->getOriginal('category_supplier_name2')) {
            array_push($data_changes, [
                'field'     => 'category_supplier_name2',
                'old_value' => $product->getOriginal('category_supplier_name2'),
                'new_value' => $product->category_supplier_name2
            ]);
        }
        if ($product->category_supplier_name3 != $product->getOriginal('category_supplier_name3')) {
            array_push($data_changes, [
                'field'     => 'category_supplier_name3',
                'old_value' => $product->getOriginal('category_supplier_name3'),
                'new_value' => $product->category_supplier_name3
            ]);
        }
        if ($product->part_number != $product->getOriginal('part_number')) {
            array_push($data_changes, [
                'field'     => 'part_number',
                'old_value' => $product->getOriginal('part_number'),
                'new_value' => $product->part_number
            ]);
        }
        if ($product->collection != $product->getOriginal('collection')) {
            array_push($data_changes, [
                'field'     => 'collection',
                'old_value' => $product->getOriginal('collection'),
                'new_value' => $product->collection
            ]);
        }
        if ($product->width != $product->getOriginal('width')) {
            array_push($data_changes, [
                'field'     => 'width',
                'old_value' => $product->getOriginal('width'),
                'new_value' => $product->width
            ]);
        }
        if ($product->height != $product->getOriginal('height')) {
            array_push($data_changes, [
                'field'     => 'height',
                'old_value' => $product->getOriginal('height'),
                'new_value' => $product->height
            ]);
        }
        if ($product->length != $product->getOriginal('length')) {
            array_push($data_changes, [
                'field'     => 'length',
                'old_value' => $product->getOriginal('length'),
                'new_value' => $product->length
            ]);
        }
        if ($product->weight != $product->getOriginal('weight')) {
            array_push($data_changes, [
                'field'     => 'weight',
                'old_value' => $product->getOriginal('weight'),
                'new_value' => $product->weight
            ]);
        }
        if ($product->width2 != $product->getOriginal('width2')) {
            array_push($data_changes, [
                'field'     => 'width2',
                'old_value' => $product->getOriginal('width2'),
                'new_value' => $product->width2
            ]);
        }
        if ($product->height2 != $product->getOriginal('height2')) {
            array_push($data_changes, [
                'field'     => 'height2',
                'old_value' => $product->getOriginal('height2'),
                'new_value' => $product->height2
            ]);
        }
        if ($product->length2 != $product->getOriginal('length2')) {
            array_push($data_changes, [
                'field'     => 'length2',
                'old_value' => $product->getOriginal('length2'),
                'new_value' => $product->length2
            ]);
        }
        if ($product->weight2 != $product->getOriginal('weight2')) {
            array_push($data_changes, [
                'field'     => 'weight2',
                'old_value' => $product->getOriginal('weight2'),
                'new_value' => $product->weight2
            ]);
        }
        if ($product->width_packaging != $product->getOriginal('width_packaging')) {
            array_push($data_changes, [
                'field'     => 'width_packaging',
                'old_value' => $product->getOriginal('width_packaging'),
                'new_value' => $product->width_packaging
            ]);
        }
        if ($product->height_packaging != $product->getOriginal('height_packaging')) {
            array_push($data_changes, [
                'field'     => 'height_packaging',
                'old_value' => $product->getOriginal('height_packaging'),
                'new_value' => $product->height_packaging
            ]);
        }
        if ($product->length_packaging != $product->getOriginal('length_packaging')) {
            array_push($data_changes, [
                'field'     => 'length_packaging',
                'old_value' => $product->getOriginal('length_packaging'),
                'new_value' => $product->length_packaging
            ]);
        }
        if ($product->weight_packaging != round($product->getOriginal('weight_packaging'), 3)) {
            array_push($data_changes, [
                'field'     => 'weight_packaging',
                'old_value' => $product->getOriginal('weight_packaging'),
                'new_value' => $product->weight_packaging
            ]);
        }
        if ($product->width_master != $product->getOriginal('width_master')) {
            array_push($data_changes, [
                'field'     => 'width_master',
                'old_value' => $product->getOriginal('width_master'),
                'new_value' => $product->width_master
            ]);
        }
        if ($product->height_master != $product->getOriginal('height_master')) {
            array_push($data_changes, [
                'field'     => 'height_master',
                'old_value' => $product->getOriginal('height_master'),
                'new_value' => $product->height_master
            ]);
        }
        if ($product->length_master != $product->getOriginal('length_master')) {
            array_push($data_changes, [
                'field'     => 'length_master',
                'old_value' => $product->getOriginal('length_master'),
                'new_value' => $product->length_master
            ]);
        }
        if ($product->weight_master != $product->getOriginal('weight_master')) {
            array_push($data_changes, [
                'field'     => 'weight_master',
                'old_value' => $product->getOriginal('weight_master'),
                'new_value' => $product->weight_master
            ]);
        }
        if ($product->unit_box != $product->getOriginal('unit_box')) {
            array_push($data_changes, [
                'field'     => 'unit_box',
                'old_value' => $product->getOriginal('unit_box'),
                'new_value' => $product->unit_box
            ]);
        }
        if ($product->unit_palet != $product->getOriginal('unit_palet')) {
            array_push($data_changes, [
                'field'     => 'unit_palet',
                'old_value' => $product->getOriginal('unit_palet'),
                'new_value' => $product->unit_palet
            ]);
        }
        if ($product->min_sales_unit != $product->getOriginal('min_sales_unit')) {
            array_push($data_changes, [
                'field'     => 'min_sales_unit',
                'old_value' => $product->getOriginal('min_sales_unit'),
                'new_value' => $product->min_sales_unit
            ]);
        }
        if ($product->cbm != $product->getOriginal('cbm')) {
            array_push($data_changes, [
                'field'     => 'cbm',
                'old_value' => $product->getOriginal('cbm'),
                'new_value' => $product->cbm
            ]);
        }
        if ($product->object_type_1 != $product->getOriginal('object_type_1')) {
            array_push($data_changes, [
                'field'     => 'object_type_1',
                'old_value' => $product->getOriginal('object_type_1'),
                'new_value' => $product->object_type_1
            ]);
        }
        if ($product->price_catalog != $product->getOriginal('price_catalog')) {
            array_push($data_changes, [
                'field'     => 'price_catalog',
                'old_value' => $product->getOriginal('price_catalog'),
                'new_value' => $product->price_catalog
            ]);
        }
        if ($product->price_wholesale != $product->getOriginal('price_wholesale')) {
            array_push($data_changes, [
                'field'     => 'price_wholesale',
                'old_value' => $product->getOriginal('price_wholesale'),
                'new_value' => $product->price_wholesale
            ]);
        }
        if ($product->price_retail != $product->getOriginal('price_retail')) {
            array_push($data_changes, [
                'field'     => 'price_retail',
                'old_value' => $product->getOriginal('price_retail'),
                'new_value' => $product->price_retail
            ]);
        }
        if ($product->price != $product->getOriginal('price')) {
            array_push($data_changes, [
                'field'     => 'price',
                'old_value' => $product->getOriginal('price'),
                'new_value' => $product->price
            ]);
        }
        if ($product->tax != $product->getOriginal('tax')) {
            array_push($data_changes, [
                'field'     => 'tax',
                'old_value' => $product->getOriginal('tax'),
                'new_value' => $product->tax
            ]);
        }
        if ($product->stock != $product->getOriginal('stock')) {
            array_push($data_changes, [
                'field'     => 'stock',
                'old_value' => $product->getOriginal('stock'),
                'new_value' => $product->stock
            ]);
        }
        if ($product->stock_catalog != $product->getOriginal('stock_catalog')) {
            array_push($data_changes, [
                'field'     => 'stock_catalog',
                'old_value' => $product->getOriginal('stock_catalog'),
                'new_value' => $product->stock_catalog
            ]);
        }
        if ($product->stock_to_show != $product->getOriginal('stock_to_show')) {
            array_push($data_changes, [
                'field'     => 'stock_to_show',
                'old_value' => $product->getOriginal('stock_to_show'),
                'new_value' => $product->stock_to_show
            ]);
        }
        if ($product->stock_available != $product->getOriginal('stock_available')) {
            array_push($data_changes, [
                'field'     => 'stock_available',
                'old_value' => $product->getOriginal('stock_available'),
                'new_value' => $product->stock_available
            ]);
        }
        if ($product->assortment != $product->getOriginal('assortment')) {
            array_push($data_changes, [
                'field'     => 'assortment',
                'old_value' => $product->getOriginal('assortment'),
                'new_value' => $product->assortment
            ]);
        }
        if ($product->vmd != $product->getOriginal('vmd')) {
            array_push($data_changes, [
                'field'     => 'vmd',
                'old_value' => $product->getOriginal('vmd'),
                'new_value' => $product->vmd
            ]);
        }
        if ($product->new != $product->getOriginal('new')) {
            array_push($data_changes, [
                'field'     => 'new',
                'old_value' => $product->getOriginal('new'),
                'new_value' => $product->new
            ]);
        }
        if ($product->active != $product->getOriginal('active')) {
            array_push($data_changes, [
                'field'     => 'active',
                'old_value' => $product->getOriginal('active'),
                'new_value' => $product->active
            ]);
        }

        if (count($data_changes) > 0) {
            return $data_changes;
        } else {
            return false;
        }
    }

    public function checkProductAttributesChanges(Product $product, Array $attributes)
    {
        $data_changes = array();

        foreach ($attributes as $attribute) {
            $attributeId = Attribute::where('name', $attribute['attribute_name'])->first()->id;
            $productAttribute = ProductAttribute::where('product_id', $product->id)->where('attribute_id', $attributeId)->first();
            if ($productAttribute) {
                if ($productAttribute->value != $attribute['attribute_value'] ) {
                    array_push($data_changes, [
                        'field' => $productAttribute->attribute->name,
                        'old_value' => $productAttribute->value,
                        'new_value' => $attribute['attribute_value']
                    ]);
                }
            }
        }

        if (count($data_changes) > 0) {
            return $data_changes;
        } else {
            return false;
        }
    }
}