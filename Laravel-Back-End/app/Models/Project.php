<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['project_name', 'project_description', 'creator_id'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function todos() {
        return $this->hasMany(Todo::class);
    }

    public function canvases() {
        return $this->hasMany(FreeCanvas::class);
    }

    public function leanCanvases() {
        return $this->hasOne(LeanCanvas::class);
    }

    public function announcements() {
        return $this->hasMany(Announcement::class);
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
