<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'priority',
        'status',
        'reported_at',
    ];

    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class);
    }
}
