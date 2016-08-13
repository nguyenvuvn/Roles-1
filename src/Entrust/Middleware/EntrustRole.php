<?php namespace Hoanghiep\Role\Middleware;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hoanghiep\Role
 */

use Closure;
use Illuminate\Contracts\Auth\Guard;

class EntrustRole
{
	protected $auth;

	/**
	 * Creates a new instance of the middleware.
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
	 * @param  Closure $next
	 * @param  $roles
	 * @return mixed
	 */
	public function handle($request, Closure $next, $roles)
	{
		if ($this->auth->guest() || !$request->user()->hasRole(explode('|', $roles))) {
			abort(403);
		}

		return $next($request);
	}
}
