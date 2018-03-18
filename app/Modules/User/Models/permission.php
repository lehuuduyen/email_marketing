<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'id',
        'name',
        'description',
        'display_name'
    ];

}
