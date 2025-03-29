<?php

namespace App\Http\Middleware;

use App\Constants\CommonConstant;
use App\Exceptions\InvalidTokenException;
use App\Exceptions\TokenExpiredException;
use App\Services\Auth\JWTService;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->header('Authorization', '');
            $token = str_replace('Bearer ', '', $token);
            JWTService::decryptFileBasedToken($token);

            return $next($request);
        } catch (TokenExpiredException $e) {
            return response()->json(['status' => CommonConstant::ERROR, 'message' => $e->getMessage()], $e->getCode());
        } catch (InvalidTokenException $e) {
            return response()->json(['status' => CommonConstant::ERROR, 'message' => $e->getMessage()], $e->getCode());
        } catch (Exception $e) {
            return response()->json(['status' => CommonConstant::ERROR, 'message' => 'Invalid Token'], 401);
        }
    }
}
