<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'id_number',
        'year',
        'department_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function scopeSearch($query, $terms)
    {
        // 'Moses Block' $terms
        // ['Moses', 'Block'] exloded into array
        // {['Moses', 'Block']} wrap into collection
        
        collect(explode(' ', $terms))->filter()->each(function($term) use($query)
        {
            $term = '%'.$term.'%';

            $query->where(function($query) use($term){
                $query->whereIn('user_id', function($query) use($term){
                    $query->select('id')
                        ->from('users')
                        ->where('name', 'like', $term);
                })
                ->orWhereIn('department_id', function($query) use($term){
                    $query->select('id')
                        ->from('departments')
                        ->where('acronym', 'like', $term);
                });
            });

        });

    }
}
