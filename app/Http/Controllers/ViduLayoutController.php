<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViduLayoutController extends Controller
{   
    function sach()
    {
        $data = DB::select("select * from sach order by gia_ban asc limit 0,8");
        return view("vidusach.index", compact("data"));
    }

    function theloai($id)
    {
        $data = DB::select("select * from sach where the_loai = ?",[$id]);
        return view("vidusach.index", compact("data"));
    }

    function chitiet($id)
    {
        $sach = DB::select("select * from sach where id = ?", [$id]);
        if (count($sach) > 0) {
            return view("vidusach.chitiet", ['sach' => $sach[0]]);
        }
        return redirect('/sach');
    }
}