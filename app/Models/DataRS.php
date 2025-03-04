<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataRS extends Model
{
    use HasFactory;

    protected $table = 'data_rs';

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_telp'
    ];


    public function dataPasien()
    {
        // Menyatakan bahwa satu rumah sakit (DataRS) dapat memiliki banyak pasien (DataPasien)
        return $this->hasMany(DataPasien::class, 'rs_id', 'id');
    }
}
