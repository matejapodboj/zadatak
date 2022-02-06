<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }

    public function getFIle(Request $request)
    {
        $pom = 0;
        dd($request->get('product_categories'));
        if($request->hasFile('product_categories.csv')){
            $file = $request->file('product_categories.csv');
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if($pom > 0){
                    $product_category = new ProductCategory;
                    $product_category->product_number = $column[0];
                    $product_category->category_name = $column[1];
                    $product_category->department_name = $column[2];
                    $product_category->manufacturer_name = $column[3];
                    $product_category->upc = $column[4];
                    $product_category->sku = $column[5];
                    $product_category->regular_price = $column[6];
                    $product_category->sale_price = $column[7];
                    $product_category->description = $column[8];
                }
                $pom = $pom + 1;
            }

        }
    }
}
