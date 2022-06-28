<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesByParent = Category::where('status', '1')->where('parent_id', '=', '0')->get();
        $categories = Category::where('status', '1')->where('parent_id', '!=', '0')->inRandomOrder()->limit(5)->get();
        $products = Product::all();
        $categoriesTop1 = Category::where('status', '1')->orderBy('id', 'DESC')->limit(1)->get();
        $categoriesTop4 = Category::where('status', '1')->orderBy('id', 'DESC')->skip(1)->take(4)->get();
        $products = Product::where('status', '1')->inRandomOrder()->limit(8)->get();
        $productTop3Create = Product::where('status', '1')->orderBy('created_at', 'DESC')->take(3)->get();
        $productTop3Sale = Product::where('status', '1')->orderBy('discount_percent', 'DESC')->take(3)->get();
        $productTop3feature = Product::where('status', '1')->inRandomOrder()->limit(3)->get();
        return view('frontend.home.index')->with([
            'categoriesTop1' => $categoriesTop1,
            'categoriesTop4' => $categoriesTop4,
            'products' => $products,
            'categories' => $categories,
            'categoriesByParent' => $categoriesByParent,
            'productTop3Create' => $productTop3Create,
            'productTop3feature' => $productTop3feature,
            'productTop3Sale' => $productTop3Sale,

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
        //
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
}
