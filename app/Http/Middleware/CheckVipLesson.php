<?php

namespace App\Http\Middleware;

use App\Models\Lesson;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckVipLesson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lessonId = $request->route('lesson'); // assuming route param: {lesson}
        $lesson = Lesson::findOrFail($lessonId);

        $user = $request->user();

        if ($lesson->is_vip && !$user->is_vip) {
            return response()->json([
                'message' => 'این درس vip هست جون دللللللل'
            ], 403);
        }
        return $next($request);
    }
}
