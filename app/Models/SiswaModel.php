<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;

    protected $table = 'santri_ma';
    protected $primaryKey = 'nim';
    protected $fillable = ['nim', 'fullname', 'tanggal_lahir', 'email', 'tempat_lahir', 'alamat', 'kelas'];
}