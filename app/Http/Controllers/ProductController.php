<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreProductRequest;
use App\Providers\Action;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductSetting;
use App\Providers\EnglishConvertion;
use Response;
use File;
use Redirect;

class ProductController extends Controller
{
    // List
    public function list(Request $request) {
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Subcategories
        $vars['subcategories'] = Subcategory::select('name','id')->get();
        
        $dataTable = new ProductDataTable;

        $vars['productTable'] = $dataTable->html();
        
        return view('product.list', $vars);
    }

    // Rendering DataTable
    public function productTable(ProductDataTable $datatable) {
        return $datatable->render('product.list');
    }

    // Store product
    public function store(StoreProductRequest $request) {
        // Id
        $id = $request->get('id');

        Product::updateOrCreate(
            ['id' => $id],
            ['name' => $request->get('name'), 'model' => $request->get('model'),'price' => $request->get('price'), 
            'size' => $request->get('size'),'description' => $request->get('description'), 'category_id' => $request->get('categories'), 
            'subcategory_id' => $request->get('subcategories')]
        );

        return $this->getAction($request->get('button_action'));
    }


    // Product SubSet
    public function subSet($request) {
        // Category Or Sub Category
        switch($request) {
            case '':
                return null;
                break;
            default:
                return $request;
        }
    }

    // Edit Data
    public function edit(Action $action,Request $request) {   
        return $action->edit(Product::class,$request->get('id'));
    }

    // Delete Each Product
    public function delete(Action $action, $id) {
        return $action->delete(Product::class,$id);
    }

    // Each Data for displaying
    public function each($id) {
        $product = Product::find($id);
        return view("/product/eachProduct",[
            "product" => $product
        ]);
    }

    // Get all products in products page
    public function show(Request $request) {

        // Product Setting
        $names = [
            'header_image',
            'header_text',
            'header_desc'
        ];

        $productSettings = ProductSetting::whereIn('name', $names)->get();
        $vars = []; 
        foreach($productSettings as $product) {
            $vars["product_$product->name"] = $product->value;
        }

        $vars['products'] = Product::query();

        // If category is requested
        if($request->has('category_id')) {
            $vars['products']->where('category_id', $request->category_id)->get();
        }
        // If subcategory is requested
        else if($request->has('subcategory_id')) {
            $vars['products']->where('category_id', $request->category_id)->get();
        }

        if($vars['products'] > 0) 
            return view('product.products',$vars);
        else 
            return Redirect::to('product/products')->with('faliure', 'متاسفانه محصولی با این دسته بندی پیدا نشد');
    } 

    // Search
    public function search(Request $request) {

        $name = $request->get('search');

        // If Search is requested
        if(!empty($name)) {
            $products = Product::where('name',$name)->paginate(9);

            if(count($products) > 0)
                return view('product.products', compact('products'));
            else 
                return Redirect('/product/products')->with('faliure', 'متاسفانه محصولی با این نام پیدا نشد');
        } 
        else {
            return Redirect('/product/products')->with('faliure','لطفا نوشته مورد نظر خود را جستجو کنید');
        }

    }
}

