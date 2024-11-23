<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantar extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'file_surat_pengantar'
    ];

    // Definisikan relasi jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pengajuanJudul()
    {
        return $this->belongsTo(PengajuanJudul::class, 'user_id', 'users_id');
    }
}
