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
        'user_id'
    ];
    
    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function purposes(){
        return $this->belongsToMany(Purpose::class, 'facilities_purposes');
    }
}
