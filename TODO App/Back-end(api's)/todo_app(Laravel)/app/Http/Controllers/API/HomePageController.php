<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    //
    function home()
    {
        // echo Carbon::parse(Carbon::today())->format('Y-m-d');
        // die();


        /**
         * @var App\Models\User $user
         */
        $user = Auth::user();
        $tasks = $user->load(['tasks' => function ($query) {
            $query->whereDate('date', Carbon::today());
        }])->tasks;

        return response()->json([
            'tasks' => $tasks,
        ], Response::HTTP_ACCEPTED);
    }
}
