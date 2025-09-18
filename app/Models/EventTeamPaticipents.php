<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTeamPaticipents extends Model
{
    protected $table = 'event_team_paticipents';
    protected $fillable = [
        'id',
        'registration_id',
        'name',
        'email',
        'contact_number',
        'class',
        'division',
        // Add other fields as necessary
    ];
}
