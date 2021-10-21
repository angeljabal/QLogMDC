<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'facility_id',
        'purpose_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function facility(){
        return $this->hasOne(Facility::class);
    }

    public function purpose(){
        return $this->hasOne(Purpose::class);
    }
}
