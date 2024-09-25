<?php
namespace App\Http\Traits\Api;

use App\Http\Traits\Api\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ApiException
{
    use ApiResponse;
    public static function apiException($e)
    {

        if ($e instanceof NotFoundHttpException) {
            return ApiResponse::apiResponse(null, ('not found'), 404);
        }
        if ($e instanceof ModelNotFoundException) {
            return ApiResponse::apiResponse(null, ('not found'), 404);
        }
        if ($e instanceof AuthorizationException) {
            return ApiResponse::apiResponse(null, ('Not authorized'), 401);
        }
        if ($e instanceof AccessDeniedHttpException) {
            return ApiResponse::apiResponse(null, ('Not authorized'), 401);
        }
        if ($e instanceof AuthenticationException) {
            return ApiResponse::apiResponse(null, ('Not authorized'), 401);
        }
        if ($e instanceof HttpException && $e->getStatusCode() === 403) {
            return ApiResponse::apiResponse(null, 'Your email address is not verified.', 403);
        }
    } 
}