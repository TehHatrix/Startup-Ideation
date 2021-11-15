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
        return $this->hasMany(Revenue::class);
    }

    public function uniqueValueProposition() {
        return $this->hasMany(UniqueValueProposition::class);
    }
    
    public function channel() {
        return $this->hasMany(Channel::class);
    }

    public function keyMetric() {
        return $this->hasMany(KeyMetric::class);
    }

    public function CostStructure() {
        return $this->hasMany(CostStructure::class);
    }   

    public function unfairAdvantage() {
        return $this->hasMany(UnfairAdvantage::class);
    }

}
