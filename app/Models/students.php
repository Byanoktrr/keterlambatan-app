<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\models\rayon;
use app\models\rombel;

class students extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function rayon(){
        return $this->belongsTo(rayon::class, 'rayon_id', 'id');
    }
    public function rombel(){
        return $this->belongsTo(rombel::class, 'rombel_id', 'id');
    }
}
