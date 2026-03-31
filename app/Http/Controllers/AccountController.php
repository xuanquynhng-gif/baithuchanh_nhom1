<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {
    public function accountpanel() {
        $data = DB::table("users")->where("id", Auth::user()->id)->first();
        return view("vidusach.account", compact("data"));
    }

    public function saveaccountinfo(Request $request) {
        $updateData = ['name' => $request->name, 'email' => $request->email];
        if ($request->hasFile('photo')) {
            $fileName = Auth::user()->id . '.' . $request->file('photo')->extension();
            $request->file('photo')->storeAs('public/profile', $fileName);
            $updateData['photo'] = $fileName;
        }
        DB::table("users")->where("id", Auth::user()->id)->update($updateData);
        return redirect()->back()->with('status', 'Cập nhật thành công!');
    }
}
