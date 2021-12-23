<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SantriModel extends Model
{
    use HasFactory;

    protected $table = 'santri';
    protected $primaryKey = 'nim';
    protected $fillable = ['nim', 'fullname', 'tanggal_lahir', 'email', 'tempat_lahir', 'alamat', 'kelas'];
}