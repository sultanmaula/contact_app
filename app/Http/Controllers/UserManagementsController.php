<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementsController extends Controller
{
    public function index()
    {
        $data['users'] = DB::table('users')->get();

        return view('usermanagement.index', $data);
    }

    public function add()
    {
        return view('usermanagement.add');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required'
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('user-management');
    }

    public function edit($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->get();

        return view('usermanagement.edit', $data);
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'     => 'required',
            'email'    => 'required',
        ]);

        if ($request->password == '') {
            DB::table('users')->where('id', $id)->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            DB::table('users')->where('id', $id)->update([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect()->route('user-management');
    }

    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
    }
}