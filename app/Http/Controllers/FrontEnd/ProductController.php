<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        $images = Image::all();
        $products = Product::where('status', '1')->orderBy('id', 'desc')->paginate(9);
        return view('frontend.products.index')->with([
            'products' => $products,
            'images' => $images,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('slug', $id)->first();
        $productTop3Sale = Product::where('status', '1')->orderBy('discount_percent', 'DESC')->take(4)->get();
        return view('frontend.products.show')->with([
            'products' => $products,
            'productTop3Sale' => $productTop3Sale
        ]);
    }
    public function details($slug)
    {
        $products = Product::where('slug', $slug);
        return view('frontend.products.show')->with([
            'products' => $products
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function productByCategories($slug)
    {
        $categories = Category::get();
        $categoryname = Category::firstwhere('slug', $slug);
        return view('frontend.products.productsByCategory')->with([
            'categories' => $categories,
            'categoryname' => $categoryname,
        ]);
    }
}
