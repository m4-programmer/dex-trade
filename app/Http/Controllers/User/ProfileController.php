<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Profile Setup';
        return view('theme2.user.profile', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        // dd($user);
        
        $profile = User::find(auth()->user()->id);
        
        $request->validate([

            'profile_pics' => ['image','nullable'],
            'email' => ['required', 'string', 'email', 'max:255',
             'unique:users,email,'.auth()->user()->id],
            'fname' => ['required', 'string', 'max:255', ],
            'username' => ['required', 'string', 'min:5', 'unique:users,username,'.auth()->user()->id],
            'phone' => ['required', 'numeric', 'min:5', ],
            'country' => ['nullable', 'string', 'max:100', ],
            'state' => ['nullable', 'string', 'max:100', ],
            'city' => ['nullable', 'string', 'max:100', ],
            'zip' => ['nullable', 'string', 'max:100', ],

        ]);
        // dd($profile);
        
         
         
         
        if ($request->hasfile('profile_pics')) { // check if picture is uploaded and uploads it
            $destination = 'asset/theme2/images/user/'.$profile->profile_pics;
            // when user uploads a new image this will delete the old image
            if (FILE::exists($destination)) {
                FILE::delete($destination);
            // dd($profile->profile_pics);
            }
            $file = $request->file('profile_pics');
            $filename = 'asset/theme2/images/user/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('asset/theme2/images/user/', $filename);
            $profile->image = $filename;

        }
        
            
            $profile->name =$request->fname;
            $profile->username =$request->username;
            $profile->email =$request->email;
            
            $profile->phone =$request->phone;
            
            
            
            $profile->city =$request->city;
            $profile->state =$request->state;
            $profile->country =$request->country;
            $profile->zip =$request->zip;
         
        $save = $profile->update();
    
        return back()->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}
