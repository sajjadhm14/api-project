<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return response()->json($task);
    }
    
    public function store(Request $request)
    {
        $user = $request->user(); // از auth:sanctum می‌گیره
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => $request->completed ?? false,
            'user_id' => $user->id
        ]);
        return response()->json($task, 201);
    }
        public function show($id)
         {
            $task = Task::find($id);
            if (!$task) {
                return response()->json(['message' => 'Task not found'], 404);
            }
        return response()->json($task, 200);
    }

    public function update(Request $request ,$id)
    {
      $user = $request->user(); // از auth:sanctum می‌گیره
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        if ($task->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->update([
            'title' => $request->title ?? $task->title,
            'description' => $request->description ?? $task->description,
            'completed' => $request->completed ?? $task->completed
        ]);
        return response()->json($task, 200);
    
    }
    
    public function destroy(Request $request,$id)
    {
       $user = $request->user(); // از auth:sanctum می‌گیره
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        if ($task->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted'], 200);
    
    }
}
