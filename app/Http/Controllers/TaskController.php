<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()
            ->where('status', 'pending')
            ->orderBy('updated_at', 'desc')
            ->get();

        if ($tasks->isNotEmpty()) {
            return response()->json($tasks);
        } else {
            return response()->json([], 404);
        }
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());

        return response()->json($task ?? [], $task ? 200 : 500);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->fill(['status' => $request->get('status')]);
            $task->save();
        }

        return response()->json([], $task ? 200 : 404);
    }

    public function destroy($id)
    {
        //
    }
}
