<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'description', 'publisher_id'];

    public function canvas() {
        return $this->belongsTo(LeanCanvas::class);
    }
}
