<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MyAccountsController extends Controller
{
    public function index()
    {
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->get();

        return view('myaccount.index', $data);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'     => 'required',
            'email'    => 'required',
        ]);

        if ($request->password == '') {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            DB::table('users')->where('id', Auth::user()->id)->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('my-account');
    }
}