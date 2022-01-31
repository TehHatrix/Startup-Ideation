<?php

use App\Models\FreeCanvas;
use App\Models\FreeCanvasContent;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// everything in the a project 
Broadcast::channel('Project.{projectId}', function ($user, $projectId) {
    $project = Project::find($projectId);
    $userArr = $project->users()->wherePivot('user_id', '=', $user->id)->get();
    return $userArr[0]->id == $user->id;
});

// channel for project chat 
Broadcast::channel('chat.{projectId}', function ($user, $projectId) {
    $project = Project::find($projectId);
    $userArr = $project->users()->wherePivot('user_id', '=', $user->id)->get();

    return $userArr[0]->id == $user->id;
    // return true;
});


// outside project 
Broadcast::channel('ProjectList.{userId}', function($user, $userId) {
    return $user->id == $userId;
});

// free canvas channel 
Broadcast::channel('FreeCanvas.{canvasId}', function($user, $canvasId) {
    $canvas = FreeCanvas::find($canvasId);
    $project = Project::find($canvas->project_id);
    $userArr = $project->users()->wherePivot('user_id', '=', $user->id)->get();
    return $userArr[0]->id == $user->id;
});