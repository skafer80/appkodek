<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IpUser extends Model
{
    protected $table = 'ip_users';

    protected $fillable = [
        'ip_address',
        'user_id',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
