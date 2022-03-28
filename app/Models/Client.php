<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getfullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointmentsInfo()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }
}
