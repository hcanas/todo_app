<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskHistoryController extends Controller
{
    public function index()
    {
        $tasks = Task::query()
            ->where('status', '!=', 'pending')
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
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
