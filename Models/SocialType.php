<?php

namespace Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Models\Branch;

class SocialType extends Eloquent
{
    
    protected $table = 'social_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}
