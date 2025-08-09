<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // in bara show prof client hast 
    public function index ()
    {
        
      $user = Auth::user();
      
      return response ()->json([
        'success ' => 'true' ,
        'data' => $user
      ]);
    }

    public function store(StoreUserProfileRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
       
    
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        $data = $request -> validated();
        $user->fill($data);
        
        if ($request->hasFile('avatar')){
            if($user -> avatar && Storage::disk('public')->exists($user->avatar)){
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'your profile created successfully',
        ]);
    }
}
