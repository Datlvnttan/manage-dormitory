<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomUserController extends Controller
{
    public function changeRoom()
    {
        return view("user.room.change_room");
    }
}
