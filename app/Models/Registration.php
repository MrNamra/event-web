<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'id',
        'event_id',
        'team_name',
        'team_size',
        'category_id'
        
        // Add other fields as necessary
    ];
    public function team()
    {
        return $this->hasMany(EventTeamPaticipents::class, 'registration_id');
    }
}
