<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriModel extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $primaryKey = 'id';
    protected $fillable = ['image','nim', 'fullname','tahun_ajaran','status', 'tanggal_lahir', 'email', 'tempat_lahir', 'alamat', 'kelas'];
}