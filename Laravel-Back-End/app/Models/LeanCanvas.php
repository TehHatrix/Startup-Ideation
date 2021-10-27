<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeanCanvas extends Model
{
    use HasFactory;
    protected $primaryKey = 'canvasID';
    protected $fillable = [
        'canvasID',
        'created_at',
        'updated_at',
    ];
}
