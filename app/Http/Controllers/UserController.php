<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserProfileRequest;
use App\Models\User;
use App\Models\Avatar; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // in bara show prof client hast 
    public function index ()
    {
      /** @var \App\Models\User $user */  
      $user = Auth::user();

      $userData = $user ->toArray();

      $userData['avatar'] = $user->avatar 
        ? Storage::url($user->avatar->avatar_path) 
        : null;
      
      return response ()->json([
        'success ' => 'true' ,
        'data' => $user
      ]);
    }

    public function store(StoreUserProfileRequest $request)
    {
  /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $data = $request->validated();

        unset($data['avatar']);

        $user->fill($data);
        $user->save();

        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::disk('public')->exists($user->avatar->avatar_path)) {
                Storage::disk('public')->delete($user->avatar->avatar_path);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');

            // اگر آواتار قبلا بوده آپدیت کن، در غیر اینصورت ایجاد کن
            if ($user->avatar) {
                $user->avatar->update([
                    'avatar_path' => $avatarPath
                ]);
            } else {
                $user->avatar()->create([
                    'avatar_path' => $avatarPath
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Your profile updated successfully',
        ]);
    }
}
