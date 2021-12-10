<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = array('pivot');

    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function purposes(){
        return $this->belongsToMany(Purpose::class, 'facilities_purposes');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $terms)
    {
        collect(explode(' ', $terms))->filter()->each(function($term) use($query)
        {
            $term = '%'.$term.'%';

            $query->where(function($query) use($term){
                $query->where('name', 'like', $term)
                    ->orWhere('code', 'like', $term);
            });
        });

    }
}
