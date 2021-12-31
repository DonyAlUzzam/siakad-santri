<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMaModel extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_ma';
    protected $primaryKey = 'id';
    protected $fillable = ['nim_bayar', 'periode', 'pembayaran_1', 'pembayaran_2', 'pembayaran_3', 'kelas', 'tanggal_bayar', 'tahun_ajaran', 'daftar_ulang', 'raport', 'uas_ganjil', 'uas_genap', 'lain_lain'];
}