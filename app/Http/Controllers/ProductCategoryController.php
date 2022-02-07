<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        if($request->hasFile('product_categories')){
            $file = $request->file('product_categories');
            $file = fopen($file, "r");
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                if($pom > 1){
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

                    $product_category->save();
                }
                $pom = $pom + 1;
            }

        }
        return response::Json('True');
    }

    public function showAllCategories(Request $request)
    {
        $categories = [];

        $product_categories = ProductCategory::all();

        foreach($product_categories as $product_category){
            if(!in_array($product_category->category_name, $categories)){
                array_push($categories, $product_category->category_name);
            }
            
        }

        return Response::json([
            'categories' => $categories
        ]);
    }

    public function renameCategory(Request $request)
    {
        $old_category = $request->get('old_category');
        $new_category = $request->get('new_category');

        $product_categories = ProductCategory::where('category_name', $old_category)->get();

        foreach($product_categories as $product_category)
        {
            $product_category->category_name = $new_category;
            $product_category->save();
        }

        return Response::json([
            'product_categories' => $product_categories
        ]);
        
    }

    public function deleteCategory(Request $request)
    {
        $category_name = $request->get('category_name');

        $product_categories = ProductCategory::where('category_name', $category_name)->get();

        foreach($product_categories as $category){
            $category->delete();
        }

        return Response::json([
            'categories' => $product_categories
        ]);
    }

    public function deleteProduct(Request $request)
    {
        $product_number = $request->get('product_number');

        $product = ProductCategory::where('product_number', $product_number)->first();
        return Response::json($product->delete());
    }

    public function showProducts()
    {
        $products = ProductCategory::all();

        return Response::json([
            'products' => $products
        ]);
    }

    public function showCategoryProduct(Request $request)
    {
        $category_name = $request->get('category_name');
        $products = ProductCategory::where('category_name', $category_name)->get();

        return Response::json([
            'product' => $products
        ]);
    }

    public function updateProduct(Request $request)
    {
        $params = $request->except('product_number');
        $product_number = $request->get('product_number');
        $product = ProductCategory::where('product_number', $product_number)->first();

        foreach($params as $param => $value){
            if($param == 'product_number'){
                $product->product_number = $value;
            }
            if($param == 'category_name'){
                $product->category_name = $value;
            }
            if($param == 'department_name'){
                $product->department_name = $value;
            }
            if($param == 'manufacturer_name'){
                $product->manufacturer_name = $value;
            }
            if($param == 'upc'){
                $product->upc = $value;
            }
            if($param == 'sku'){
                $product->sku = $value;
            }
            if($param == 'regular_price'){
                $product->regular_price = $value;
            }
            if($param == 'sale_price'){
                $product->sale_price = $value;
            }
            if($param == 'description'){
                $product->description = $value;
            } 

        }
        $product->save();
        
        return Response::json([
            'product' => $product
        ]);
    }
}
