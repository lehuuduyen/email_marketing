<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\User\Models\permission;
class RoleController extends Controller
{
    public function home(){
        $permissions= permission::query()->pluck('name','id')->toArray();
        return view('user::role.list',compact('permissions'));
    }

}
