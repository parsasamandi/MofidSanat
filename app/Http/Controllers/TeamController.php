<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\DataTables\TeamDataTable;
use App\Providers\SuccessMessages;
use App\Providers\Action;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use App\Models\Media;
use DB;

class TeamController extends Controller
{
    // Get team
    public function list(Request $request) {
        
        $dataTable = new TeamDataTable;

        $vars['teamTable'] = $dataTable->html();

        return view('teamList', $vars);
    }

    // Render Datatable
    public function teamTable(TeamDataTable $datatable) {
        return $datatable->render('teamList');
    }

    // Store
    public function store(StoreTeamRequest $request, Action $action) {

        DB::transaction(function() use($request) {
            // Id
            $id = $request->get('id');

            $team = Team::updateOrCreate(
                ['id' => $id],
                ['name' => $request->get('name'), 'responsibility' => $request->get('responsibility'), 
                'linkedin_address' => $request->get('linkedin'), 'size' => $request->get('size')]
            );

            // Insert or update
            if($request->hasFile('image')) {
                // Team image
                $action->image($request, $team->id, Team::class);
            }
        });

        return $this->getAction($request->get('button_action'));
    }

    // Edit 
    public function edit(Action $action, Request $request) {
        return $action->edit(Team::class, $request->get('id')); 
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Team::class, $id);
    }
}
