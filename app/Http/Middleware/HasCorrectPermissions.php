<?php namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Keep\Exceptions\NotAuthorizedException;

class HasCorrectPermissions {

    protected $auth;

    /**
     * Constructor.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws NotAuthorizedException
     */
	public function handle($request, Closure $next)
	{
        $user = $this->auth->user();

        $action = $request->route()->getAction();

        if (array_key_exists('permissions', $action))
        {
            if (! ($this->auth->check() && $user->ability([], $action['permissions'])))
            {
                throw new NotAuthorizedException($user->name . ' does not have the required permission(s) to perform this request.');
            }
        }

		return $next($request);
	}

}