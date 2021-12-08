<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    // protected $primaryKey = 'problem_ID';
    // protected $fillable = [
    //     'problem_ID',
    //     'canvas_ID',
    //     'topic',
    //     'description',
    //     'publisher',
    // ];

    protected $fillable = ['topic', 'description', 'publisher_id'];

    public function canvas() {
        return $this->belongsTo(LeanCanvas::class);
    }

    public function custproblem(){
        return $this->hasMany(CustomerProblem::class);
    }
}
