<?php

namespace App\Imports;

use App\Models\Product;
use App\Custom\ImportProductData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $eansArray = explode(',', $row['ean']);

        $dataModel = array();
        $dataModel = [
            'id'                             => $row['product_id'],
            'sku_provider'                   => $row['sku_provider'],
            'ean'                            => $eansArray[0],
            'provider_full_description'      => $row['provider_full_description'],
            'provider_short_description'     => $row['provider_short_description'],
            'provider_attribute_description' => $row['provider_attribute_description'],
            'provider_name'                  => $row['provider_name'],
            'intrastat'                      => $row['intrastat'],
            'brand_supplier_name'            => $row['brand_supplier_name'],
            'category_supplier_name'         => $row['category_supplier_name'],
            'category_supplier_name2'        => $row['category_supplier_name2'],
            'category_supplier_name3'        => $row['category_supplier_name3'],
            'width'                          => round($row['width'], 2),
            'height'                         => round($row['height'], 2),
            'length'                         => round($row['length'], 2),
            'width2'                         => round($row['width_2'], 2),
            'height2'                        => round($row['height_2'], 2),
            'length2'                        => round($row['length_2'], 2),
            'weight'                         => round($row['weight_kg'], 2),
            'width_packaging'                => round($row['width_packaging'], 2),
            'height_packaging'               => round($row['height_packaging'], 2),
            'length_packaging'               => round($row['length_packaging'], 2),
            'weight_packaging'               => round($row['weight_packaging'], 3),
            'cbm'                            => round($row['cbm'], 4),
            'object_type_1'                  => $row['object_type_1'],
            'seo_keywords'                   => $row['seo_keywords'],
            'price_catalog'                  => round($row['coste_price'], 2),
            'price'                          => round($row['pvr_price'], 4),
            'source'                         => 'xlsx'
        ];

        $attributesArray = array();
        for ($i=1; $i < 69; $i++) {
            $attributesArray[] = [
                'attribute_name'        => $row['attribute_' . $i],
                'attribute_value'       => isset($row['value_' . $i]) ? $row['value_' . $i] : null
            ];
        }

        $import = new ImportProductData;

        $product = Product::find($row['product_id']);
        if (!$product) {
            $product = $import->createProduct($dataModel, $eansArray, $attributesArray, null);
        } else {
            $product = $import->updateProduct($product, $dataModel, $attributesArray);
        }
    }
}
