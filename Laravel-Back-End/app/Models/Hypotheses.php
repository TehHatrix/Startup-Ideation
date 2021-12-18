<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hypotheses extends Model
{
    use HasFactory;
    protected $primaryKey = 'hypothesis_ID';
    protected $fillable = [
        'hypothesis_ID',
        'problem_id',
        'pain_level_severity',
        'pain_level_freq',
        'feedback_cycle',
        'status',
    ];

    public function problem(){
        return $this->belongsTo(Problem::class,'id');
    }
}
