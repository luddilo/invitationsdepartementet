<?php
namespace App\Http\Controllers\Auth;

use App\Libraries\Repositories\UserRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';
    protected $loginPath = '/login';

    public $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @param UserRepository $userRepo
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userRepository = $userRepo;
    }

    // Login function copied from Treat and modified since we don't want to allow members to log in.
    // Only ambassadors and administrators.
    public function login(Request $request)
    {
        $userAllowedLogin = true;

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (Auth::user()->hasRoles(['Administrator', 'Ambassador'])) {
                return $this->sendLoginResponse($request);
            } else {
                $userAllowedLogin = false;
                Auth::logout();
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return redirect($this->loginPath)
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => !$userAllowedLogin ? 'Bara administratörer kan logga in' : trans('auth.failed'),
            ]);
    }
}
