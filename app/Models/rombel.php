<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rombel extends Model
{
    use HasFactory;

    protected $fillable = ['rombles'];

    public function students()
    {
        return $this->hasOne(students::class);
    }
}