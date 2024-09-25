<?php

namespace App\Traits\Api;

use Illuminate\Validation\ValidationException;

trait ApiResponse
{
    public static function apiResponse($data, $message = null, $status = 200)
    {
        $message = $message ? __($message) : ('Successful query');
        return response()->json([
            'message' => $message,
            'data'    => !empty($data) ? $data : [],
            'status'  => in_array($status, [200, 201, 202, 203]),
            'code'    => $status,
        ], $status);
    }

    public static function apiResponseStored($data)
    {
        
        return self::apiResponse($data, 'Added Successfuly', 201);
    }

    public static function apiResponseShow($data)
    {
        return self::apiResponse($data, 'Successful query', 200);
    }


    public static function apiResponseUpdated($data)
    {
        return self::apiResponse($data, 'Updated Successfuly', 200);
    }


    public static function apiResponseDeleted()
    {
        return self::apiResponse([], 'Deleted Successfuly', 200);
    }

    
    public function failedValidation($validator)
    {
        $response = $this->apiResponse($validator->errors(), ('validation error'), 422);
        throw new ValidationException($validator, $response);
    }

}
