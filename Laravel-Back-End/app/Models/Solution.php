<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'publisher_id'];

    public function canvas() {
        return $this->belongsTo(LeanCanvas::class);
    }

    public function customerSegment() {
        return $this->belongsTo(CustomerSegment::class);
    }
}
