<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller {

    public function index(Request $request) {
        $query = Product::with('prices');



        //search
        if (!empty($request->phrase)) {
            $query->where('name', 'LIKE', '%' . $request->phrase . '%');
        }

        //sorting
        if (!empty($request->order_by)) {
            switch ($request->order_by) {
                case 'name_asc':
                    $query->orderBy('name');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'DESC');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'DESC');
                    break;
            }
        }

        //filters on example of max price
        if (!empty($request->max_price)) {
            $query->whereHas('prices', function ($q) use ($request) {
                $q->where('price', '<', $request->max_price);
            });
        }


        return $query->paginate($request->limit ?? 16);
    }

    public function show($id) {

        $product = Product::with('prices')->find($id);

        if (!$product) {
            return response(null, 404);
        }

        return $product;
    }

    public function store(Request $request) {

        $this->validate($request, self::getValidationArray());
        $product = new Product();
        return $this->saveProduct($product, $request);
    }

    public function update(Request $request, $id) {

        $this->validate($request, self::getValidationArray());

        $product = Product::find($id);
        if (!$product) {
            return response(null, 404);
        }
        $product->prices()->delete();
        
        return $this->saveProduct($product, $request);
    }
    
    public static function saveProduct($product, $request) {
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        foreach ($request->prices as $productPrice) {
            $price = new Price;
            $price->product_id = $product->id;
            $price->price = $productPrice;
            $price->save();
        }
        return response($product);
    }

    public function destroy($id) {
        $product = Product::find($id);

        if (!$product) {
            return response(null, 404);
        }

        $product->delete();

        return response('success', 200);
    }

    public static function getValidationArray() {
        return [
            'name' => 'required|string|max:200',
            'description' => 'nullable|string|max:600',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:1'
        ];
    }

}
