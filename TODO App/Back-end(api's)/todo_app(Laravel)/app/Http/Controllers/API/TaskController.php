<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * here i use form request for validation
     */
    public function store(CreateTaskRequest $request)
    {
        /*
        first check if user enter specific date for created task, if user doesn't enter any date the create task with today's date
        */
        if (!$request->has('date')) {
            $request['date'] = Carbon::parse(Carbon::today())->format('Y-m-d');
        }
        $request['user_id'] = Auth::user()->id;
        $task = Task::create($request->all());

        return response()->json([
            'task' => $task
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * here i type validation rules in function
     */
    public function update(Request $request, Task $task)
    {

        if (!$this->check_authorization($task, Auth::user())) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        $request->validate([
            'title' => 'string|min:3|max:100',
            'date' => 'date|after_or_equal:today'
        ]);

        $task->update($request->all());

        return response()->json([
            'message' => 'Updated Successfully',
            'task' => $task
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // $task->delete()
    }

    private function check_authorization(Task $task, User $user)
    {
        if ($user->id != $task->user_id)
            return false;

        return true;
    }
}
