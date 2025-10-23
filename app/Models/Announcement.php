<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id', 'title', 'species', 'breed', 'age_min', 'age_max', 'sex',
        'count', 'description', 'price', 'location_city', 'main_photo', 'status', 'views'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function photos()
    {
        return $this->hasMany(AnnouncementPhoto::class, 'announcement_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'announcement_id');
    }
}
