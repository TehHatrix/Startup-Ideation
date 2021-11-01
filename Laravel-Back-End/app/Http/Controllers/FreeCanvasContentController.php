<?php

namespace App\Http\Controllers;

use App\Models\FreeCanvasContent as Content;
use App\Models\FreeCanvas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FreeCanvasContentController extends Controller
{

    public function index($canvas) {
        $content = FreeCanvas::with('contents')->where('id', $canvas);
        return response(['content' => $content], 200);
    }

    public function store(Request $request, $canvas) {
        $data = $request->validate([
            'topic' => 'required|string',
            'content' => 'required|string',
        ]);

        $content = Content::create([
            'topic' => $data['topic'],
            'content' => $data['content'],
            'publisher_id' => Auth::id(),
            'free_canvas_id' => $canvas
        ]);

        return response([
            'message' => 'success',
            'content' => $content
        ], 200);
    }

    public function show($canvas, $id) {
        $content = Content::findOrFail($id)->where('free_canvas_id', $canvas)->get();

    }

    public function update(Request $request, $canvas, $id) {
        $data = $request->validate([
            'topic' => 'required|string',
            'content' => 'required|string',
        ]);

        $content = Content::find($id)->update([
            'topic' => $data['topic'],
            'content' => $data['content']
        ]);

        return response(['content' => $content], 200);
    }

    public function destroy($canvas, $id) {
        $content = Content::find($id)->delete();
        return 'success';
    }
}
