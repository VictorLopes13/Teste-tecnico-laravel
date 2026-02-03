<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::all();

        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'completed' => false,
        ]);

        return response()->json($task, 201);
    }

    public function update(UpdateTaskRequest $request, int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task não encontrada.'], 404);
        }

        $task->update($request->validated());

        return response()->json($task, 200);
    }

    public function destroy(int $id): JsonResponse
        {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(['message' => 'Task não encontrada.'], 404);
            }

            $task->delete();

            return response()->json(['message' => 'Task deletada com sucesso.'], 200);
        }

    
    public function show(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task não encontrada.'], 404);
        }

        return response()->json($task, 200);
    }

}
