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
    public function store(StoreTeamRequest $request,SuccessMessages $message) {

        // Insert or update
        $this->addTeam($request);

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

    public function addTeam($request) {

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
        
            Team::updateOrCreate(
                ['id' => $request->get('id')],
                ['name' => $request->get('name'), 'responsibility' => $request->get('responsibility'), 
                'linkedin' => $request->get('linkedin'), 'image' => $file, 'size' => $this->convertToEnglish($request->get('size'))]
            );
        }
    }

    // Convertion
    function convertToEnglish($number) {
        $newNumbers = range(0, 9);
        // 1. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        return str_replace($persian, $newNumbers, $number);
    }

    // Delete Each Team
    public function delete(Action $action,$id) {
        return $action->deleteWithImage(Team::class,$id,'image');

    }

    // Edit Team
    public function edit(Action $action,Request $request) {
        return $action->edit(Team::class,$request->get('id')); 
    }
}
