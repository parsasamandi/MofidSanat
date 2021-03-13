<?php

namespace App\Http\Controllers;
use App\DataTables\AdminDataTable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Models\Cat;
use App\Models\User;
use File;
use Session;
use DB;


class AdminController extends Controller
{

    // Admin Home
    public function admin() {
        return view('admin.home');
    }

    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new AdminDataTable();

        // Admin Table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.list', $vars);
    }

    // get Admin
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.list');
    }

    // Store Admin
    public function store(StoreAdminRequest $request,SuccessMessages $message) {

        // Insert or update
        $this->addAdmin($request);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);
    }

    // Add Or Update Admin
    public function addAdmin($request) {

        $password = Hash::make($request->get('password'));
        User::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'email' => $request->get('email'), 'password' => $password]
        );
    }
    
    // Delete Each Admin
    public function delete(Action $action, $id) {
        return $action->delete(User::class,$id);
    }

    // Edit Data
    public function edit(Action $action,Request $request) {
        return $action->edit(User::class,$request->get('id'));
    }
}
