<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'ean',
        'sku_provider',
        'name',
        'description',
        'seo_keywords',
        'provider_full_description',
        'provider_short_description',
        'provider_attribute_description',
        'provider_name',
        'intrastat',
        'brand_name',
        'brand_supplier_name',
        'category_name',
        'category_name2',
        'category_name3',
        'category_supplier_name',
        'category_supplier_name2',
        'category_supplier_name3',
        'part_number',
        'collection',
        'width',
        'height',
        'length',
        'weight',
        'width2',
        'height2',
        'length2',
        'weight2',
        'width_packaging',
        'height_packaging',
        'length_packaging',
        'weight_packaging',
        'width_master',
        'height_master',
        'length_master',
        'weight_master',
        'unit_box',
        'unit_palet',
        'assortment',
        'min_sales_unit',
        'cbm',
        'object_type_1',
        'price_catalog',
        'price_wholesale',
        'price_retail',
        'price',
        'tax',
        'stock',
        'stock_catalog',
        'stock_to_show',
        'stock_available',
        'assortment',
        'vmd',
        'new',
        'active',
        'source'
    ];

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductAttribute');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function eans()
    {
        return $this->hasMany('App\Models\ProductEan');
    }

    public function getID()
    {
        return $this->id;
    }

    public function getSkuProvider()
    {
        return $this->sku_provider;
    }

    public function setSkuProvider($value)
    {
        $this->sku_provider = $value;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan($value)
    {
        $this->ean = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getSeoKeyWords()
    {
        return $this->seo_keywords;
    }

    public function setSeoKeyWords($value)
    {
        $this->seo_keywords = $value;
    }

    public function getProviderFullDescription()
    {
        return $this->provider_full_description;
    }

    public function setProviderFullDescription($value)
    {
        $this->provider_full_description = $value;
    }

    public function getProviderShortDescription()
    {
        return $this->provider_short_description;
    }

    public function setProviderShortDescription($value)
    {
        $this->provider_short_description = $value;
    }

    public function getProviderAttributeDescription()
    {
        return $this->provider_attribute_description;
    }

    public function setProviderAttributeDescription($value)
    {
        $this->provider_attribute_description = $value;
    }

    public function getProviderName()
    {
        return $this->provider_name;
    }

    public function setProviderName($value)
    {
        $this->provider_name = $value;
    }

    public function getIntrastat()
    {
        return $this->intrastat;
    }

    public function setIntrastat($value)
    {
        $this->intrastat = $value;
    }

    public function getBrandName()
    {
        return $this->brand_name;
    }

    public function setBrandName($value)
    {
        $this->brand_name = $value;
    }

    public function getBrandSupplierName()
    {
        return $this->brand_supplier_name;
    }

    public function setBrandSupplierName($value)
    {
        $this->brand_supplier_name = $value;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setCategoryName($value)
    {
        $this->category_name = $value;
    }

    public function getCategoryName2()
    {
        return $this->category_name2;
    }

    public function setCategoryName2($value)
    {
        $this->category_name2 = $value;
    }

    public function getCategoryName3()
    {
        return $this->category_name3;
    }

    public function setCategoryName3($value)
    {
        $this->category_name3 = $value;
    }

    public function getCategorySupplierName()
    {
        return $this->category_supplier_name;
    }

    public function setCategorySupplierName($value)
    {
        $this->category_supplier_name = $value;
    }

    public function getCategorySupplierName2()
    {
        return $this->category_supplier_name2;
    }

    public function setCategorySupplierName2($value)
    {
        $this->category_supplier_name2 = $value;
    }

    public function getCategorySupplierName3()
    {
        return $this->category_supplier_name3;
    }

    public function setCategorySupplierName3($value)
    {
        $this->category_supplier_name3 = $value;
    }

    public function getPartNumber()
    {
        return $this->part_number;
    }

    public function setPartNumber($value)
    {
        $this->part_number = $value;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function setCollection($value)
    {
        $this->collection = $value;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($value)
    {
        $this->width = $value;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($value)
    {
        $this->height = $value;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($value)
    {
        $this->length = $value;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($value)
    {
        $this->weight2 = $value;
    }

    public function getWidth2()
    {
        return $this->width2;
    }

    public function setWidth2($value)
    {
        $this->width2 = $value;
    }

    public function getHeight2()
    {
        return $this->height2;
    }

    public function setHeight2($value)
    {
        $this->height2 = $value;
    }

    public function getLength2()
    {
        return $this->length2;
    }

    public function setLength2($value)
    {
        $this->length2 = $value;
    }

    public function getWeight2()
    {
        return $this->weight2;
    }

    public function setWeight2($value)
    {
        $this->weight2 = $value;
    }

    public function getWidthPackaging()
    {
        return $this->width_packaging;
    }

    public function setWidthPackaging($value)
    {
        $this->width_packaging = $value;
    }

    public function getHeightPackaging()
    {
        return $this->height_packaging;
    }

    public function setHeightPackaging($value)
    {
        $this->height_packaging = $value;
    }

    public function getLengthPackaging()
    {
        return $this->length_packaging;
    }

    public function setLengthPackaging($value)
    {
        $this->length_packaging = $value;
    }

    public function getWeightPackaging()
    {
        return $this->weight_packaging;
    }

    public function setWeightPackaging($value)
    {
        $this->weight_packaging = $value;
    }

    public function getWidthMaster()
    {
        return $this->width_master;
    }

    public function setWidthMaster($value)
    {
        $this->width_master = $value;
    }

    public function getHeightMaster()
    {
        return $this->height_master;
    }

    public function setHeightMaster($value)
    {
        $this->height_master = $value;
    }

    public function getLengthMaster()
    {
        return $this->length_master;
    }

    public function setLengthMaster($value)
    {
        $this->length_master = $value;
    }

    public function getWeightMaster()
    {
        return $this->weight_master;
    }

    public function setWeightMaster($value)
    {
        $this->weight_master = $value;
    }

    public function getUnitBox()
    {
        return $this->unit_box;
    }

    public function setUnitBox($value)
    {
        $this->unit_box = $value;
    }

    public function getUnitPalet()
    {
        return $this->unit_palet;
    }

    public function setUnitPalet($value)
    {
        $this->unit_palet = $value;
    }

    public function getAssortment()
    {
        return $this->assortment;
    }

    public function setAssortment($value)
    {
        $this->assortment = $value;
    }

    public function getMinSalesUnit()
    {
        return $this->min_sales_unit;
    }

    public function setMinSalesUnit($value)
    {
        $this->min_sales_unit = $value;
    }

    public function getCbm()
    {
        return $this->cbm;
    }

    public function setCbm($value)
    {
        $this->cbm = $value;
    }

    public function getObjectType1()
    {
        return $this->object_type_1;
    }

    public function setObjectType1($value)
    {
        $this->object_type_1 = $value;
    }

    public function getPriceCatalog()
    {
        return $this->price_catalog;
    }

    public function setPriceCatalog($value)
    {
        $this->price_catalog = $value;
    }

    public function getPriceWholesale()
    {
        return $this->price_wholesale;
    }

    public function setPriceWholesale($value)
    {
        $this->price_wholesale = $value;
    }

    public function getPriceRetail()
    {
        return $this->price_retail;
    }

    public function setPriceRetail($value)
    {
        $this->price_retail = $value;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function setTax($value)
    {
        $this->tax = $value;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($value)
    {
        $this->stock = $value;
    }

    public function getStockCatalog()
    {
        return $this->stock_catalog;
    }

    public function setStockCatalog($value)
    {
        $this->stock_catalog = $value;
    }

    public function getStockToShow()
    {
        return $this->stock_to_show;
    }

    public function setStockToShow($value)
    {
        $this->stock_to_show = $value;
    }

    public function getStockAvailable()
    {
        return $this->stock_available;
    }

    public function setStockAvailable($value)
    {
        $this->stock_available = $value;
    }

    public function getVmd()
    {
        return $this->vmd;
    }

    public function setVmd($value)
    {
        $this->vmd = $value;
    }
}
