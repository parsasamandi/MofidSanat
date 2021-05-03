<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\DataTables\TeamDataTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Http\Requests\StoreTeamRequest;

class TeamController extends Controller
{
    // Get Team
    public function list(Request $request) {
        $dataTable = new TeamDataTable;

        $vars['teamTable'] = $dataTable->html();

        return view('teamList', $vars);
    }

    // Render DataTable
    public function teamTable(TeamDataTable $datatable) {
        return $datatable->render('teamList');
    }

    // Store Team
    public function store(StoreTeamRequest $request,SuccessMessages $message) {

        // Insert or update
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
        
            Team::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'responsibility' => $request->get('responsibility'), 
                'linkedin' => $request->get('linkedin'), 'image' => $file, 'size' => $request->get('size')]
            );
        }

        return $this->getAction($request->get('button_action'));
    }

    // Edit 
    public function edit(Action $action,Request $request) {
        return $action->edit(Team::class, $request->get('id')); 
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->deleteWithImage(Team::class, $id, 'image');
    }
}
