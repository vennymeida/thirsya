<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StatusCart;

class Pesanan extends Model
{
    use HasFactory;
	protected $primaryKey = 'id_pesanans';

	protected $fillable = [
        'id_pesanans',
        'user_id',
        'tanggal',
        'status_cart',
        'kode',
		'jumlah_harga',
		'cart_id',
		'alamat_pengiriman_id',
		'bukti_pesanan',
    ];

    public function user()
	{
		return $this->belongsTo('App\Models\User','user_id','id');
	}

	public function cart() 
	{
		 return $this->hasMany('App\Models\Cart','pesanan_id', 'id_pesanans');
	}
	public function barang() 
	{
		return $this->cart->barang;
	}

	public function alamat_pengiriman()
	{
		return $this->belongsTo('App\Models\AlamatPengiriman','alamat_pengiriman_id');
	}

	public function status_pesanan() 
	{
		 return $this->belongsTo('App\Models\StatusCart','status_cart','id');
	}
}
