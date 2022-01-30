<?php

namespace App\Http\Controllers;

use App\Events\FreeCanvasContentUpdated;
use App\Models\FreeCanvasContent as Content;
use App\Models\FreeCanvas;
use App\Models\FreeCanvasContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FreeCanvasContentController extends Controller
{
    // public function index($canvas) {
    //     $content = FreeCanvas::with('contents')->where('id', $canvas);
    //     // $content = 
    //     return response(['content' => $content], 200);
    // }
    
    // public function store(Request $request, $canvas) {
    //     $data = $request->validate([
    //         'topic' => 'required|string',
    //         'content' => 'required|string',
    //     ]);

    //     $content = Content::create([
    //         'topic' => $data['topic'],
    //         'content' => $data['content'],
    //         'publisher_id' => Auth::id(),
    //         'free_canvas_id' => $canvas
    //     ]);

    //     return response([
    //         'message' => 'success',
    //         'content' => $content
    //     ], 200);
    // }

    public function show($canvas) {
        // $content = Content::findOrFail($id)->where('free_canvas_id', $canvas)->get();
        $content = FreeCanvasContent::where('free_canvas_id', $canvas)->first();

        return response()->json([
            'content' => $content,
            'success' => true,
            'errors' => null
        ]);

    }

    public function update(Request $request, $canvas) {
        // $data = $request->validate([
        //     'content' => 'required',
        // ]);


        // $content = Content::find($id)->update([
        //     'topic' => $data['topic'],
        //     'content' => $data['content']
        // ]);

        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $data = $validator->validated();

        $content = FreeCanvasContent::where('free_canvas_id', $canvas)->first();
        $content->content = $data['content'];
        $content->save();

        broadcast(new FreeCanvasContentUpdated($canvas))->toOthers();

        return response()->json([
            'success' => true,
            'content' => $content,
        ]);

    }

    // public function destroy($canvas, $id) {
    //     $content = Content::find($id)->delete();
    //     return 'success';
    // }
}
