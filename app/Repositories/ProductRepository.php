<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Product::create($attributes);
    }

    public function update(Product $product, array $attributes)
    {
        $product->update($attributes);
        return $product;
    }

    public function delete(Product $product)
    {
        $product->delete();
        return true;
    }
}
