<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\Action;
use App\Models\Product;
use App\Models\Cat;
use App\Models\SubCat;
use App\Models\ProductSetting;
use Response;
use File;
use Redirect;


class ProductController extends Controller
{
    // List
    public function list(Request $request) {
        // Categories and SubCategories
        $vars['cats'] = Cat::select('name','id')->get();
        $vars['subCats'] = SubCat::select('name','id')->get();
        
        $dataTable = new ProductDataTable;

        $vars['productTable'] = $dataTable->html();
        
        return view('product.productsList', $vars);
    }

    // Rendering DataTable
    public function productTable(ProductDataTable $datatable) {
        return $datatable->render('product.productsList');
    }

    // Store Admin
    public function store(StoreProductRequest $request,SuccessMessages $message) {

        if($request->get('button_action') == "insert") {
            // Insert
            $this->addProduct($request);
            $success_output = $message->getInsert();
        }
        else if($request->get('button_action') == "update") {
            // Update
            $this->addProduct($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success'   =>  $success_output );
        return json_encode($output);
    }

    // Add Product
    public function addProduct($request) {
        // Edit
        $product = Product::find($request->get('id'));
        if(!$product) {
            // Storing
            $product = new Product(); 
        }
        $product->name = $request->get('name');
        $product->model = $request->get('model');
        $product->price = $this->convertToEnglish($request->get('price'));
        $product->size = $this->convertToEnglish($request->get('size'));
        $product->desc = $request->get('description');

        // Category
        $product->c_id = $this->subSet($request->get('categories'));
        // Sub Category
        $product->sc_id = $this->subSet($request->get('subCategories'));

        // Status
        $request->get('status') == 1 ? $product->status = 1 : ($request->get('status') == 0 ? $product->status = 0 : ($product->status = null));

        $product->save();
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

    // Convertion
    function convertToEnglish($number) {
        $newNumbers = range(0, 9);
        // 1. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        return str_replace($persian, $newNumbers, $number);
    }

    // Edit Data
    public function edit(Action $action,Request $request) {   
        return $action->edit(Product::class,$request->get('id'));
    }

    // Delete Each Product
    public function delete(Action $action, $id) {
        return $action->delete(Product::class,$id);
    }

    // Sub Categories to be filled based on Categories(Ajax) Section
    public function ajax_subCategory(Request $request) {
        $c_id = $request->get('c_id');
        $subCategories = SubCat::where('c_id',$c_id)->get();

        return Response::json($subCategories);
    }
    
    // Each Data for displaying
    public function each($id) {
        $product = Product::find($id);
        return view("/product/eachProduct",[
            "product" => $product
        ]);
    }

    // Get All Products In Products Page
    public function get(Request $request) {
        // If Category is requested
        if(!empty($request->get('c_id'))) {
            return $this->getProperties('c_id', $request->get('c_id'));
        }
        // If Sub Category is requested
        else if(!empty($request->get('sc_id'))) {
            return $this->getProperties('sc_id', $request->get('sc_id'));
        }
        else {
            return $this->getProperties('status',1);
        }
    }

    // Get Categories And SubCategories
    public function getProperties($column,$data) {
        // Product Setting
        $names = [
            'header_image',
            'header_text',
            'header_desc'
        ];

        $productSettings = ProductSetting::whereIn('name',$names)->get();
        $vars = [];
        foreach($productSettings as $product) {
            $vars["product_$product->name"] = $product->value;
        }

        // Search Based On Categories
        $products = Product::where($column,$data)->paginate(9);
        if(count($products) > 0)
            return view('product.products',$vars,['products' => $products]);
        else if(count($products) == 0 and $column == 'status') 
            return view('product.products',$vars,['products' => $products]);
        else 
            return Redirect::to('product/products')->with('faliure', 'متاسفانه محصولی با این دسته بندی پیدا نشد');
    }   

    // Search
    public function search(Request $request) {
        // If Search is requested
        if(!empty($request->get('search'))) {

            $name = $request->get('search');
            $products = Product::where('name',$name)->paginate(9);

            if(count($products) > 0)
                return view('product.products',['products' => $products]);
            else 
                return Redirect::to('/product/products')->with('faliure', 'متاسفانه محصولی با این نام پیدا نشد');
        } 
        else {
            return Redirect('/product/products')->with('faliure','لطفا نوشته مورد نظر خود را جستجو کنید');
        }
    }
}

