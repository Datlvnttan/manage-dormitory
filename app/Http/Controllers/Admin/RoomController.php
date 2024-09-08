<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function showRoomList()
    {
        return view("admin.room.room_list");
    }
    public function roomDetails($MaPhong)
    {
        return view("admin.room.room_details")->with("MaPhong",$MaPhong);
    }
}
