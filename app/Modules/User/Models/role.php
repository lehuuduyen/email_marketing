<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'name',
        'description',
        'display_name'
    ];
    public function permission()
    {
        return $this->belongsToMany(permission::class,'permission_role');
    }
}
