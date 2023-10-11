<?php

namespace App\Services;

use App\Models\ProductCategory;
class ProductCategoryService
{
    public function store($data)
    {
        $product = [
            'name' => $data['productCategoryName'],
            'status' => $data['productCategoryStatus'],
        ];

        return ProductCategory::create($product);
    }

    public function update($data, $id)
    {
        $product = ProductCategory::find($id);
        if (!empty($product)) {
            $productData = [
                'name' => $data['productCategoryName'],
                'status' => $data['productCategoryStatus']
            ];
            return $product->update($productData);
        }
    }
}