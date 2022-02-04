<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeanCanvas extends Model
{
    use HasFactory;
    // protected $primaryKey = 'canvasID';
    // protected $fillable = ['project_id'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function revenue() {
        return $this->hasMany(Revenue::class, 'canvas_id');
    }

    public function customerSegment() {
        return $this->hasMany(CustomerSegment::class, 'canvas_id');
    }

    public function problem() {
        return $this->hasMany(Problem::class, 'canvas_id');
    }

    public function uniqueValueProposition() {
        return $this->hasMany(UniqueValueProposition::class, 'canvas_id');
    }
    
    public function channel() {
        return $this->hasMany(Channel::class, 'canvas_id');
    }

    public function keyMetric() {
        return $this->hasMany(KeyMetric::class, 'canvas_id');
    }

    public function CostStructure() {
        return $this->hasMany(CostStructure::class, 'canvas_id');
    }   

    public function unfairAdvantage() {
        return $this->hasMany(UnfairAdvantage::class, 'canvas_id');
    }

    public function solution() {
        return $this->hasMany(Solution::class, 'canvas_id');
    }

    public function problemStatus() {
        return $this->hasMany(ProblemStatus::class, 'lean_canvas_id');
    }
}
