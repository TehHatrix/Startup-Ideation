<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;
    protected $table= 'interview'; 
    protected $primaryKey = 'interview_ID';
    protected $fillable = [
        'interview_ID',
        'hypothesis_ID',
        'script',
        'objective',
        'overall_score',
        'progress',
    ];
}
