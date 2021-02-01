<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cat;
use App\Models\SubCat;
use App\Models\ProductSetting;
use App\Models\Media;
use Response;
use File;
use Redirect;
use Session;


class ProductController extends Controller
{
    // List
    public function list(Request $request) {
        // Categories and SubCategories
        $cats = Cat::select('name','id')->get();
        $subCats = SubCat::select('name','id')->get();
        
        $dataTable = new ProductDataTable;

        $vars['productTable'] = $dataTable->html();
        
        return view('product.productsList', $vars , compact('cats','subCats'));
    }

    // Rendering DataTable
    public function productTable(ProductDataTable $datatable) {
        return $datatable->render('product.productsList');
    }

    // Sub Categories to be filled based on Categories(Ajax) Section
    public function ajax_subcat(Request $request) {
        $c_id = $request->get('c_id');
        $subCategories = SubCat::where('c_id',$c_id)->get();
        return Response::json($subCategories);
    }

    // Store Admin
    public function store(Request $request,SuccessMessages $message) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'size' => 'required|between:1,12'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        }
        else {
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
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
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
        $product->c_id = $this->subSet($request->get('category_select'));
        // Sub Category
        $product->sc_id = $this->subSet($request->get('subCategory'));

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
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    
        $string =  str_replace($persianDecimal, $newNumbers, $number);
        $string =  str_replace($arabicDecimal, $newNumbers, $number);
        $string =  str_replace($arabic, $newNumbers, $number);
        return str_replace($persian, $newNumbers, $number);
    }

    // Edit Data
    public function edit(Request $request) {   
        $product = Product::find($request->get('id'))->first();
        return json_encode($product);
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

    // Delete Each Product
    public function delete(Request $request, $id) {
        $product = Product::find($id);
        if($product) {
            $product->delete();
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }
}

