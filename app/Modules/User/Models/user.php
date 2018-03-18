<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'user';
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];
    public function role()
    {
        return $this->hasOne('App\Modules\Models\role');
    }
}
