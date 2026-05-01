<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'phone',
        'availability_status',
    ];

    public function incidents()
    {
        return $this->belongsToMany(Incident::class);
    }
}
