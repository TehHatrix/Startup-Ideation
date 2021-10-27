<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProblem extends Model
{
    use HasFactory;
    protected $table= 'CustomerProblem'; 
    protected $primaryKey = 'CustomerProblem_ID';
    protected $fillable = [
        'CustomerProblem_ID',
        'cs_ID',
        'problem_ID',
        'created_at',
        'updated_at',
    ];

    public function hypotheses(){
        return $this->hasOne(Hypotheses::class,'CustomerProblem_ID');
    }

    public function problems(){
        return $this->belongsTo(Problem::class,'problem_ID');

    }

    public function customersegments(){
        return $this->belongsTo(CustomerSegment::class,'cs_ID');
    }
}
