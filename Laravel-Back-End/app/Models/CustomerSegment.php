<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSegment extends Model
{
    use HasFactory;
    // protected $table= 'CustomerProblem'; 
    protected $primaryKey = 'cs_ID';
    protected $fillable = [
        'cs_ID',
        'canvas_ID',
        'topic',
        'description',
        'publisher',
    ];

    public function custproblem(){
        return $this->hasMany(CustomerProblem::class,'cs_ID');
    }
}
