<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $attributes);
    public function update(Product $product, array $attributes);
    public function delete(Product $product);
}
