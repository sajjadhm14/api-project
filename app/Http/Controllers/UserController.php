<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAvatarRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends Controller
{
    
        public function showAvatar()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'avatar_url' => $user->getFirstMediaUrl('avatar'),
            'avatar_thumb_url' => $user->getFirstMediaUrl('avatar', 'thumb')
        ]);
    }

    public function storeAvatar(StoreAvatarRequest $request)
    {
        
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->addMediaFromRequest('avatar')
            ->usingFileName(Str::uuid().'.'.$request->file('avatar')->getClientOriginalExtension())
            ->toMediaCollection('avatar');

        return response()->json(['message' => 'Avatar uploaded successfully']);
    }

    public function updateAvatar(StoreAvatarRequest $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->clearMediaCollection('avatar');

        $user->addMediaFromRequest('avatar')
            ->usingFileName(Str::uuid().'.'.$request->file('avatar')->getClientOriginalExtension())
            ->toMediaCollection('avatar');

        return response()->json(['message' => 'Avatar updated successfully']);
    }

    public function destroyAvatar()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->clearMediaCollection('avatar');

        return response()->json(['message' => 'Avatar deleted successfully']);
    }
}
