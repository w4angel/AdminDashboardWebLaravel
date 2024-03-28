<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class AboutUsController extends Controller
{
    public function index()
    {
        $abouts = User::all();
        return view('admin.aboutus')
        ->with('aboutus', $abouts);
    }

    public function store(Request $request)
    {
     $validator = Validator::make($request->all(), [
     // $validator =  $request->validate([
            'name' => 'required',
            'phone' =>'required|phone',
           // 'phone' =>'required|regex:/^(\+?6?01)[0-46-9]-*[0-9]{7,8}/',
            'email' => 'required|email|unique:users',
            'address' => 'required|max:255',
           'password' => 'required|string|min:8',
           'image' => 'required|image|max:2048',
        ]);

        //if ($validator->fails()) {
      //      $this->throwValidationException($request, $validator);
      //  }
//Please go to previous page to insert data & make sure it's valid.
 if ($validator->fails()) {
   $errors = $validator->errors();
  return $errors->toJson();}
  // return Redirect::back()->withErrors(['msg' => 'The message']);}
   else {

  $fileName = time() . '.' . $request->image->extension();
  $request->image->storeAs('public/images',$fileName);

  $aboutus = new User;
  $aboutus->name = $request->input('name');
  $aboutus->phone = $request->input('phone');
  $aboutus->email = trim($request->input('email'));
  $aboutus->address = $request->input('address');
  $aboutus->password = bcrypt($request->input('password'));
  $aboutus->image = $fileName;
  $aboutus->save();

        $value = 'success';
session()->flash('statuscode',$value);
return redirect('abouts')->with('status','New User Added.');
    }
}

    public function edit($id)
    {
        $aboutus = User::findOrFail($id);
        return view('admin.abouts.edit')
       ->with('aboutus',$aboutus)
       ;
    }

    public function update(Request $request, User $aboutus, $id)
    {
        $fileName = '';

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $fileName);
            if ($aboutus->image) {
              Storage::delete('public/images/' . $aboutus->image);
            }
          } else {
            $fileName = $aboutus->image;
          }

        $aboutus = User::findOrFail($id);
        $aboutus->name = $request->input('name');
        $aboutus->phone = $request->input('phone');
        $aboutus->email = trim($request->input('email'));
        $aboutus->address = $request->input('address');
        $aboutus->password = bcrypt($request->input('password'));
        $aboutus->image = $fileName;
        $aboutus->save();
        
        $value = 'info';
        session()->flash('statuscode',$value);
        return redirect('abouts')->with('status','User Updated.');
    }

    public function delete($id)
    {
        $aboutus = User::findOrFail($id);
        $aboutus->delete();

        $value = 'warning';
        session()->flash('statuscode',$value);
        return redirect('abouts')->with('status','User Deleted.');
    }
}