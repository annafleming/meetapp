<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['scheduled_at', 'agenda', 'notes', 'takeaways'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
