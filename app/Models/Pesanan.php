<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
	protected $primaryKey = 'id_pesanans';
    public function user()
	{
		return $this->belongsTo('App\Models\User','user_id', 'id');
	}

	public function cart() 
	{
		 return $this->hasMany('App\Models\Cart','pesanan_id', 'id_pesanans');
	}
}
