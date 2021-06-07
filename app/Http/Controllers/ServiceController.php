<?php

namespace App\Http\Controllers;

use App\Datatables\ServiceDataTable;
use App\Http\Requests\StoreServiceRequest;
use App\Models\Service;
use App\Providers\Action;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Datatable to blade
    public function list(Request $request) {

        $dataTable = new ServiceDataTable;

        $vars['serviceTable'] = $dataTable->html();

        return view('serviceList', $vars);
    }

    // Render
    public function serviceTable(ServiceDataTable $dataTable) {
        return $dataTable->render('serviceList');
    }

    // Store
    public function store(StoreServiceRequest $request) {

        // Insert or update
        Service::updateOrCreate(
            ['id' => $request->get('id')],
            ['title' => $request->get('title'), 'description' => $request->get('description'), 
            'font_awesome' => $request->get('font_awesome')]
        );  

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Service::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Service::class, $id);
    }
}
