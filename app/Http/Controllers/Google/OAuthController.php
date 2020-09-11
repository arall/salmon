<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hook;
use App\Models\LogType;
use App\Models\Log;
use Socialite;

class OAuthController extends Controller
{
    /**
     * @var App\Models\Hook
     */
    protected $hook;

    /**
     * Driver
     */
    protected $driver;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->driver = Socialite::driver('google')->redirectUrl(request()->root() . '/g/o/callback');
    }

    /**
     * View auth form
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $hook = Hook::where('token', $request->token)->first();

        // Create the log
        if ($hook) {
            $hook->logs()->create([
                'type_id' => LogType::clicked()->first()->id,
                'ip' => $request->ip(),
            ]);

            $token = $hook->token;
        } else {
            $token = 'fake_token';
        }

        $scopes = [
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://mail.google.com/'
        ];

        return $this->driver->scopes($scopes)->with(['state' => $token])->stateless()->redirect();
    }

    /**
     * Google OAuth callback.
     *
     * @return Response
     */
    public function callback(Request $request)
    {
        $hook = Hook::where('token', $request->state)->first();

        $user = $this->driver->stateless()->user();
        $email = $user->getEmail();

        // Create the log
        if ($hook) {
            $hook->logs()->create([
                'type_id' => LogType::filled()->first()->id,
                'data' => $email ? 1 : 0,
                'ip' => $request->ip(),
            ]);
        }

        return view('phished');
    }
}
