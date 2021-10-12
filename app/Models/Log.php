<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'user_id',
        'queue_number'
    ];

    public function facility(){
        return $this->belongsTo(Facility::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
