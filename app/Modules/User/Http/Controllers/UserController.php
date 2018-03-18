<?php

namespace App\Modules\User\Http\Controllers;

use App\Api\V1\Controllers\BaseController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function home(){
        return view('user::user.list');
    }
    public function home_add(){
      $roles=  RoleApiController::get();
        return view('user::user.add',compact('roles'));
    }
}
