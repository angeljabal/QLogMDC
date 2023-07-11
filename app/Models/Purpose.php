<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = array('pivot');

    public function offices()
    {
        return $this->belongsToMany(Office::class, 'offices_purposes');
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function scopeSearch($query, $terms)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%' . $term . '%';

            $query->where(function ($query) use ($term) {
                $query->where('title', 'like', $term);
            });
        });
    }
}
