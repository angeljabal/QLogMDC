<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function facilities(){
        return $this->belongsToMany(Facility::class, 'facilities_purposes');
    }
}
