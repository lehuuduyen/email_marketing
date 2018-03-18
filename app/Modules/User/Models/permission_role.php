<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class permission_role extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
        'id',
        'name',
        'description',
        'display_name'
    ];
    public $timestamps = false;
}
