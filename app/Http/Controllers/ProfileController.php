<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(request()->user()->id);
        return view('pages.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->user()->id);

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'gender' => 'required',
            'birth' => 'required',
            'photo' => 'image'
        ]);

        $request->password == null ? $user->password : $request['password'] = bcrypt($request->password);
        if ($request->hasFile('photo')) {
            $request['avatar'] = $this->imageUpload(
                $request->file('photo'), 
                str_replace(' ', '', $request->name)
            );
            if ($user->avatar != null) $this->imageDelete($user->avatar);
        }

        $user->update($request->all());

        request()->session()->flash('success', 'Profile successfully updated.');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Upload Image
     */
    public function imageUpload($file, $name)
    {
        $photo = $file;
        $fileName = date('ymdHis') . '-' . $name . '.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . 'avatar';
        $photo->move($destinationPath, $fileName);
        return 'image' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . $fileName;
    }

    /**
     * Delete image
     */
    public function imageDelete($name)
    {
        unlink($name);
    }
}
