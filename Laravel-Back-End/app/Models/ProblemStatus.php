<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemStatus extends Model
{
    use HasFactory;

    protected $fillable = ['validated'];

    public function problem() {
        return $this->belongsTo(Problem::class);
    }

    public function canvas() {
        return $this->belongsTo(LeanCanvas::class, 'lean_canvas_id');
    }
}
