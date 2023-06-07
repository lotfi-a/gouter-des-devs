<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Topic extends Eloquent
{
    protected $collection = 'Topic';

    protected $fillable = [
        'title',
        'description',
        'likes',
        'userId',
        'created_at',
    ];

}
