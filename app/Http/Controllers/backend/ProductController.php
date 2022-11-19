<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-product');
        $this->middleware('permission:create-product', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-product', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-product', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.product.index');
    }


    public function create()
    {
        $categories = Category::pluck('category_name', 'id');
        return view('backend.product.create', compact('categories'));
    }


    public function store(ProductStoreRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        $product = $request->except('featured_image');
        if ($request->featured_image) {
            $product['featured_image'] = parse_url($request->featured_image, PHP_URL_PATH);
        }
        Product::create($product);
        flash(trans('messages.deleted.created'))->success();
        return redirect()->route('product.index');
    }


    public function show(Product $product)
    {
        $product->with(['category', 'user']);
        return view('backend.product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $product->with(['category', 'user']);
        $categories = Category::pluck('category_name', 'id');
        return view('backend.product.edit', compact('categories', 'product'));
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        $productdata = $request->except('featured_image');
        if ($request->featured_image) {
            $productdata['featured_image'] = parse_url($request->featured_image, PHP_URL_PATH);
        }
        $product->update($productdata);
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('product.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        flash(trans('messages.deleted.updated'))->info();
        return redirect()->route('product.index');
    }
}
