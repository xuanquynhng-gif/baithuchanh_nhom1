<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{   
   public function bookview(Request $request) {
    $the_loai = $request->input('the_loai');

    if ($the_loai == "") {
        $data = DB::select("select * from sach limit 0,10");
    } else {
        $data = DB::select("select * from sach where the_loai = ?", [$the_loai]);
    }

    return view("vidusach.bookview", compact("data"));
}
}