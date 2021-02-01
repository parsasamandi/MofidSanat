<?php

namespace App\Http\Controllers;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\subCat;
use App\Models\Product;
use App\Models\home_setting;
use App\Models\Media;
use App\Models\User;
use DataTables;
use File;
use Session;
use DB;


class AdminController extends Controller
{

    public function list() {
        // dataTable
        $dataTable = new AdminDataTable();

        // Admin Table
        $vars['adminTable'] = $dataTable->html();

        return view('adminList', $vars);
    }

    // get Admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('adminList');
    }

    // Store Admin
    public function store(Request $request,SuccessMessages $message) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'nullable|min:6|',
            'password2' => 'same:password',
            'email' => 'email|unique:users,email,' . $request->get('id')
        ]);
        
        $error_array = array();
        $success_output = '';

        if ($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }
        }
        else {
             // Insert
            if($request->get('button_action') == "insert") {
                $this->addAdmin($request);
                $success_output = $message->getInsert();
            }
            // Update
            else if($request->get('button_action') == 'update') {
                $this->addAdmin($request);
                $success_output = $message->getUpdate();
            }
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        return json_encode($output);
    }

    // Add Or Update Admin
    public function addAdmin($request) {
        // Edit
        $admin = User::find($request->get('id'));
        if(!$admin) {
            // Insert
            $admin = new User();
        }
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        if($request->get('password') != 'رمز عبور جدید' and $request->get('password') != 'تکرار رمز عبور جدید')
            $admin->password = Hash::make($request->get('password'));

        $admin->save();
    }
    // Delete Each Admin
    public function delete(Request $request, $id) {
        $admin = User::find($id);
        if($admin) {
            $admin->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit Data
    public function edit(Request $request) {
        $admin = User::find($request->get('id'));
        return json_encode($admin);
    }

    // Admin Home
    public function admin() {
        return view('adminHome');
    }


}
