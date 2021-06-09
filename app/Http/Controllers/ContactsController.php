<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ContactsController extends Controller
{
    public function index()
    {
        $data['contacts'] = DB::table('contacts')->get();

        return view('contact.index', $data);
    }

    public function add()
    {
        return view('contact.add');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'   => 'required',
            'email'  => 'required',
            'date'   => 'required',
            'phone'  => 'required',
            'gender' => 'required'
        ]);

        $url = URL::to('/contact_image');
        
        $filename_photo = '';
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $image_directory = 'contact_image';
            $filename_photo = time()."_".$photo->getClientOriginalName();
            $photo->move($image_directory, $filename_photo);
        }

        if ($filename_photo == '') {
            $filename_photo = 'default.png';
        }

        if ($request->photo == '') {
            $data = "$request->name,$request->email,$request->date,$request->phone,$request->gender";
        } else {
            $data = "$request->name,$request->email,$request->date,$request->phone,$request->gender,$filename_photo";
        }

        
        $name = strtolower($request->name);
        $slug = preg_replace('~[^\pL\d]+~u', "_", $name);
        $filename = $slug."_".date('dmYHis').".txt";

        
        DB::table('contacts')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'birthdate'  => $request->date,
            'phone'      => $request->phone,
            'gender'     => $request->gender,
            'photo'      => $filename_photo,
            'url_photo'  => $url.'/'.$filename_photo,
            'filename'   => $filename,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
        Storage::disk('local')->put($filename, $data);

        return redirect()->route('contact');
    }

    public function edit($id)
    {
        $data['contact'] = DB::table('contacts')->where('id', $id)->get();

        return view('contact.edit', $data);
    }

    public function update(Request $request, $file)
    {
        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'name'   => 'required',
            'email'  => 'required',
            'date'   => 'required',
            'phone'  => 'required',
            'gender' => 'required'
        ]);

        $url = URL::to('/contact_image');
        
        $filename_photo = '';
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $image_directory = 'contact_image';
            $filename_photo = time()."_".$photo->getClientOriginalName();
            $photo->move($image_directory, $filename_photo);
        }

        if ($filename_photo == '') {
            $filename_photo = 'default.png';
        }

        if ($request->photo == '') {
            $data = "$request->name,$request->email,$request->date,$request->phone,$request->gender";
        } else {
            $data = "$request->name,$request->email,$request->date,$request->phone,$request->gender,$filename_photo";
        }

        $name = strtolower($request->name);
        $slug = preg_replace('~[^\pL\d]+~u', "_", $name);
        $filename = $slug."_".date('dmYHis').".txt";

        Storage::delete($file);

        DB::table('contacts')->where('filename', $file)->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'birthdate'  => $request->date,
            'phone'      => $request->phone,
            'gender'     => $request->gender,
            'photo'      => $filename_photo,
            'url_photo'  => $url.'/'.$filename_photo,
            'filename'   => $filename,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        Storage::disk('local')->put($filename, $data);

        return redirect()->route('contact');
    }

    public function delete($file)
    {
        $data['contact'] = DB::table('contacts')->where('filename', $file)->get();
        
        $file_photo = 'contact_image/'.$data['contact'][0]->photo;
        if (is_file($file_photo)) {
            unlink($file_photo);
        }
        
        Storage::delete($file);
        
        DB::table('contacts')->where('filename', $file)->delete();
    }

    public function delete_image($file)
    {
        $data['contact'] = DB::table('contacts')->where('filename', $file)->get();
        
        $file_photo = 'contact_image/'.$data['contact'][0]->photo;
        if (is_file($file_photo)) {
            unlink($file_photo);
        }

        DB::table('contacts')->where('filename', $file)->update([
            'photo'      => '',
            'url_photo'  => '',
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('contact');
    }
}