<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $fillable = ['user_id', 'name', 'phone', 'address', 'email', 'city', 'country', 'postal_code', 'bio', 'facebook', 'twitter', 'instagram', 'linkedin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
