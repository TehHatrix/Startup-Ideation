<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeCanvasContent extends Model
{
    use HasFactory;
    protected $fillable = ['topic', 'content', 'publisher_id', 'free_canvas_id'];

    public function canvas() {
        return $this->belongsTo(FreeCanvas::class);
    }
}
