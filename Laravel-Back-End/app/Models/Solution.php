<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'description', 'publisher_id'];

    public function canvas() {
        return $this->belongsTo(FreeCanvas::class);
    }
}
