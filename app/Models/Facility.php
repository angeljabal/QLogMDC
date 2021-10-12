<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'head',
        'building',
        'room_number'
    ];

    public function purposes(){
        return $this->hasMany(Purpose::class);
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }
}
