<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Feedback extends Eloquent
{
    protected $collection = 'Feedback';
    protected $fillable = [
        'rank',
        'description'
    ];
}
