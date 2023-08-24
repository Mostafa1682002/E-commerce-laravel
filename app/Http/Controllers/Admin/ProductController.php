<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categores = Category::get();
        return view('Admin.Products.index', compact('products', 'categores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProduct $request)
    {
        $List_products = $request->List_products;
        foreach ($List_products as $producte) {
            $imge_name = $producte['image']->getClientOriginalName();
            $product = new Product();
            $product->product_name = $producte['product_name'];
            $product->categorie_id = $producte['categorie_id'];
            $product->price = $producte['price'];
            $product->discount = $producte['discount'];
            $product->total_price = ($producte['price'] - (($producte['discount'] / 100) * $producte['price']));
            $product->image = $imge_name;
            $product->save();
            $producte['image']->storeAs('Images', "$product->id/$imge_name", 'imge_products');
        }
        return redirect()->back()->with('succes', 'تم حفظ البيانات بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProduct $request, $id)
    {
        $product = Product::findOrFail($id);
        if ($request->hasFile('image')) {
            $imge_name = $request->file('image')->getClientOriginalName();
            $product->update([
                "product_name" => $request->product_name,
                "categorie_id" => $request->categorie_id,
                "price" => $request->price,
                "discount" => $request->discount,
                "total_price" => $request->price - (($request->discount / 100) * $request->price),
                "image" => $imge_name,
            ]);
            Storage::disk('imge_products')->deleteDirectory("Images/$id");
            $request->file('image')->storeAs('Images', "$id/$imge_name", 'imge_products');
        } else {
            $product->update([
                "product_name" => $request->product_name,
                "categorie_id" => $request->categorie_id,
                "price" => $request->price,
                "discount" => $request->discount,
                "total_price" => ($request->price - (($request->discount / 100) * $request->price)),
            ]);
        }
        return redirect()->back()->with('succes', 'تم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Storage::disk('imge_products')->deleteDirectory("Images/$id");
        return redirect()->back()->with('succes', 'تم حذف المنتج بنجاح');
    }
}