<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Event extends Eloquent
{
    protected $collection = 'Event';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'users',
        'feedbackId',
        'date_of_event',
    ];
}
