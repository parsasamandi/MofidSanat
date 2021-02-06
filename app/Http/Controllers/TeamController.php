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
    public $team = 'App\Models\Team';
    // Get Team
    public function index(Request $request) {
        $dataTable = new TeamDataTable;

        $vars['teamTable'] = $dataTable->html();

        return view('teamList', $vars);
    }

    // Render DataTable
    public function teamTable(TeamDataTable $datatable) {
        return $datatable->render('teamList');
    }

    // Store Team
    public function store(StoreTeamRequest $request,SuccessMessages $message)
    {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addTeam($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->addTeam($request);
            $success_output = $message->getUpdate();
        }
        $output = array('success' => $success_output);

        return json_encode($output);
    }

    public function addTeam($request) {
        // Edit
        $team = Team::find($request->get('id'));
        // Insert
        if(!$team) {
            $team = new Team();
        }
        $team->name = $request->get('name');
        $team->responsibility = $request->get('responsibility');
        $team->linkedin_address = $request->get('linkedin');
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
            $team->image = $file;
        }
        $team->size = $request->get('size');

        $team->save();

    }

    // Delete Each Team
    public function delete(Action $action,$id) {
        return $action->deleteWithImage($this->team,$id,'image');

    }

    // Edit Team
    public function edit(Action $action,Request $request) {
        return $action->edit($this->team,$request->get('id')); 
    }
}
