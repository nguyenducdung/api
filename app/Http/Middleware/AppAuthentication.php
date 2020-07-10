<?php

namespace App\Http\Middleware;
use App\Services\AuthService;
use Closure;
use Illuminate\Http\JsonResponse;

class AppAuthentication
{
    /** @var AuthService $authService */
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->authService->verifyToken($request->header('Authorization'));
        if (!$user) {
            return response()->json(['error' => "Unauthorized"], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $request->request->add(['user' => $user]);

        return $next($request);
    }
}
