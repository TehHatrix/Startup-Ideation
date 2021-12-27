<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\AndVersionConstraintGroup;

class AnnouncementController extends Controller
{
    public function index($projectId) {
        $announcements = Project::find($projectId)->announcements;


        return response()->json([
            'success' => true,
            'announcements' => $announcements,
            'errors' => null
        ]);
    }

    public function store(Request $request, $projectId) {
        $validator = Validator::make($request->all(), [
            'title' => 'required', 
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false]);
        }
        $data = $validator->validated();

        $project = Project::find($projectId);

        $announcement = New Announcement();
        $announcement->title = $data['title'];
        $announcement->description = $data['description'];
        $announcement->publisher_id = Auth::id();
        $announcement->project()->associate($project);
        $announcement->save();

        return response()->json([
            'success' => true,
            'announcement' => $announcement,
            'errors' => null
        ]);
    }

    public function show() {
        // ? idk if needed 
    }

    public function update(Request $request, $projectId, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required', 
            'description' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false]);
        }
        $data = $validator->validated();

        $ann = Announcement::where('id', $id)->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);

        return response()->json([
            'success' => true,
            'announcement' => $ann,
            'errors' => null
        ]);
        


    }

    public function destroy($projectId, $id) {
        $ann = Announcement::find($id);
        if($ann->publisher_id == Auth::id()) {
            $ann->delete();
            return response()->json([
                'success' => true,
                'errors' => null
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => 'not authorized'
        ]);

        
    }
    
}
