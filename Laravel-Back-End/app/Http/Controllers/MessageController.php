<?php

namespace App\Http\Controllers;

use App\Events\communication\ChatUpdated;
use App\Models\Message;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId)
    {
        $project = Project::with('messages')->find($projectId);
        $messages = $project->messages()->get();

        return response()->json([
            'messages' => $messages,
            'success' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'user_id' => 'required'            
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();


        $project = Project::find($projectId);

        $message = new Message;
        $message->message = $data['message'];
        $message->user_id = $data['user_id'];
        $message->project()->associate($project);
        $message->save();
        
        broadcast(new ChatUpdated($projectId))->toOthers();

        return response()->json([
            'success' => true,
            'erros' => null
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        // also no need i guess
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        // no need update 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy($projectId, $messageId)
    {

        $message = Message::find($messageId);
        if($message->user_id == Auth::id()) {
            $message->delete();
            broadcast(new ChatUpdated($projectId))->toOthers();

            return response()->json([
                'success' => true,
                'errors' => null
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => 'note authorized'
        ]);
    }
}
