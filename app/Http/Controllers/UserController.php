<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showAvatar()
    {
         /** @var \App\Models\User $user */  
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $avatarUrl = $user->getFirstMediaUrl('avatar', 'thumb');

        return response()->json([
            'avatar_url' => $avatarUrl ?: null,
        ]);
}
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $user = $request->user();
        // حذف آواتار قبلی
        $user->clearMediaCollection('avatar');

        // اضافه کردن آواتار جدید
        $user->addMediaFromRequest('avatar')
             ->toMediaCollection('avatar');

        return response()->json([
            'message' => 'Avatar updated successfully',
            'avatar_url' => $user->getFirstMediaUrl('avatar', 'thumb')
        ]);
    }
}
