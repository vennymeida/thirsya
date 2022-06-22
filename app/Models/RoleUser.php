<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_users';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id'
        
    ];
    public function role()
    {
        return $this->hasMany(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
