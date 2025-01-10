<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'username', 'email', 'address', 'phone', 'bio', 'photo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-profile.png');
    }

}
