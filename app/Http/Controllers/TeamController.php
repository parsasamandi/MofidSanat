<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\DataTables\TeamDataTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Providers\SuccessMessages;

class TeamController extends Controller
{
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
    public function store(Request $request,SuccessMessages $message)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'responsibility' => 'required',
            'size' => 'required|integer|between:1,12',
            'image' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else {
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
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
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
    public function delete(Request $request,$id) {
        $team = Team::find($request->input('id'));
        if($team) {
            $imageDelete = public_path("images/$team->image");
            if($imageDelete) {
                File::delete($imageDelete); 
            }
            $team->delete(); 
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit Team
    public function edit(Request $request) {
        $team = Team::find($request->get('id'));
        return json_encode($team); 
    }
}
