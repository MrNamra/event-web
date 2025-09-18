<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'short_des',
        'start_date',
        'end_date',
        'registration_open',
        'banner_image',
        'is_active',
    ];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    
    public function participants()
    {
        return $this->hasMany(Registration::class);
    }
    public function categoriess()
    {
        return $this->hasMany(Category::class);
    }
}
