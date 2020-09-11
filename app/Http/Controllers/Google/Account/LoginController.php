<?php

namespace App\Http\Controllers\Google\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hook;
use App\Models\LogType;
use App\Models\Log;

class LoginController extends Controller
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
        $this->middleware('hook:https://myaccount.google.com/security');

        $this->hook = Hook::where('token', request()->token)->first();
    }

    /**
     * View login the form
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Create the log
        if ($this->hook) {
            $this->hook->logs()->create([
                'type_id' => LogType::clicked()->first()->id,
                'ip' => $request->ip(),
            ]);

            $token = $this->hook->token;
            $email = $this->hook->target->email;
        } else {
            $token = $request->token;
            $email = 'test@example.com';
        }

        return view('google.account.login')->with(['token' => $token, 'email' => $email]);
    }

    /**
     * Submit login the form
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        // Create the log
        if ($this->hook) {
            $this->hook->logs()->create([
                'type_id' => LogType::filled()->first()->id,
                'data' => $request->password ? 1 : 0,
                'ip' => $request->ip(),
            ]);
        }

        return redirect('phished');
    }
}
