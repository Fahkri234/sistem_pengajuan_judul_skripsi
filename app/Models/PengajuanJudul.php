<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanJudul extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'abstrak',
        'status',
        'alasan_penolakan',
        'bukti_pembayaran',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suratPengantar()
    {
        return $this->hasOne(SuratPengantar::class, 'users_id', 'user_id');
    }
    
}
