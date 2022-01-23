<?php

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

Broadcast::channel('first-test', function() {
    return Auth::check();
});

Broadcast::channel('first-try', function($user) {
    return true;
});

Broadcast::channel('project', function ($user, $projectId) {
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