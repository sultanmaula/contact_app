<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardsController extends Controller
{
    public function index()
    {
        $data['users'] = DB::table('users')->count();
        $data['contacts'] = DB::table('contacts')->count();

        return view('dashboard.index', $data);
    }
}