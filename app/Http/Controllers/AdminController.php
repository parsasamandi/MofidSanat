<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use App\Http\Requests\StoreAdminRequest;
use App\Providers\Action;
use App\Providers\SuccessMessages;
use App\Models\Category;
use App\Models\User;
use File;
use Session;
use DB;

class AdminController extends Controller
{

    // Admin home
    public function admin() {
        return view('admin.home');
    }

    // DataTable to blade
    public function list() {
        // dataTable
        $dataTable = new AdminDataTable();

        // Admin table
        $vars['adminTable'] = $dataTable->html();

        return view('admin.list', $vars);
    }

    // Get 
    public function adminTable(AdminDataTable $dataTable) {
        return $dataTable->render('admin.list');
    }

    // Store
    public function store(StoreAdminRequest $request) {

        // Insert or update
        $password = Hash::make($request->get('password'));

        User::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'email' => $request->get('email'), 'password' => $password]
        );

        return $this->getAction($request->get('button_action'));
    }
    
    // Edit 
    public function edit(Action $action, Request $request) {
        return $action->edit(User::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(User::class, $id);
    }
}
