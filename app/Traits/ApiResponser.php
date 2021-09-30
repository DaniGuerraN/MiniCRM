<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Build success response
     * @param  string|array $data
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data,'success' => true], $code);
    }


    /**
     * Build error responses
     * @param  string|array $message
     * @param  int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST )
    {
        return response()->json(['error' => $message, 'success' => false], $code);
    }
}
