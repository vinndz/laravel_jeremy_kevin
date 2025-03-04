<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    use HasFactory;

    protected $table = 'data_pasien';

    protected $fillable = [
        'rs_id',
        'nama',
        'alamat',
        'no_telp'
    ];

    public function dataRS()
    {
        return $this->belongsTo(DataRS::class, 'rs_id');  
    }

}
