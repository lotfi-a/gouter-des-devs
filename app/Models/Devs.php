<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Devs extends Eloquent
{
    protected $collection = 'User';

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "picture",
        "feedbacks",
        "topics",
        "events",
        "created_at",
        "updated_at"
    ];
}
