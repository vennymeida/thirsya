<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

     // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswa
     protected $table = 'barangs';
    protected $primaryKey = 'id'; // Memanggil isi DB Dengan primarykey
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'nama_barang',
        'harga',
        'stok',
        'keterangan',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function cart() 
	{
	     return $this->hasMany('App\Models\Cart','barang_id', 'id');
	}
    

}
