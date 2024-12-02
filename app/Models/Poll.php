<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote',
        'author',
        'context',
        'analysis',
        'title',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}


