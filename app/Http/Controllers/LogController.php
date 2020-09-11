<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogType;
use App\Models\Log;
use App\Models\Hook;

class LogController extends Controller
{
    /**
     * @var App\Models\Hook
     */
    protected $hook;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('hook');

        $this->hook = Hook::where('token', request()->token)->first();
    }

    /**
     * Logs an opened email.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function email(Request $request)
    {
        $this->hook->logs()->create([
            'type_id' => LogType::opened()->first()->id,
            'ip' => $request->ip(),
            'data' => $request->server('HTTP_USER_AGENT'),
        ]);
    }
}
