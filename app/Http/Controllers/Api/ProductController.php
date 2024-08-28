<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getAll();
        if ($products->count() > 0) {
            return ProductResource::collection($products);
        } else {
            return response()->json(['message' => 'No Data Found'], 200);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|string',
            'description' => 'required',
        ]);
// without fillable
        // $product = new Product();
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->description = $request->description;
        // $product->save();
// with fillable
        // $product = Product::create([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'description' => $request->description
        // ]);
        $product = $this->productRepository->create($request->all());

        // dd($request);

        return response()->json([
            'message' => 'Data created  successfully',
            "data" => $product
        ], 200);
    }

    public function show($id)
    {
        //dd($id);
        $product = $this->productRepository->getById($id);
        return new ProductResource($product);

    }

    public function update(Request $request,$id)
    {
       dd("The requested data is",$request,"And the  id is",$id);

    $product = Product::findOrFail($id);



    $validatedData = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'description' => 'sometimes|string',
        'price' => 'sometimes|required|string',
    ]);
    dd("The product data is",$request,"And the  validated data is",$validatedData);
$UpdatedProduct=$this->productRepository->update($product,$validatedData);
    //$product->update($validatedData);


    return response()->json([
        'message' => 'Product updated successfully',
        'product' => $UpdatedProduct
    ]);

    }

    public function destroy(Product $product)
    {
        //dd($product);
        $DeletedProduct=$this->productRepository->delete($product);
//$product->delete();
return response()->json([
    'message'=> 'deleted successfully',
    'deleted'=> $DeletedProduct

],200);

    }
}






