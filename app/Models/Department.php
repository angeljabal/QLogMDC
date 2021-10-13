<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'acronym',
        'dean'
    ];

    
    public function profiles(){
        return $this->hasMany(Profile::class);
    }
}
