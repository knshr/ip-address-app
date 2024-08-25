<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponsesJson
{
    public function response($isSuccessful,$data,$message,$errors,$responCode= Response::HTTP_OK)
    {
        return new JsonResponse(
            array(
                'isSuccessful' => $isSuccessful,
                'values' => $data,
                'message' => $message,
                'errors' => $errors
            ),
            $responCode
        );
    }

    public function successfulResponse($data = null, $message = 'Request success.')
    {
        return $this->response(true, $data, $message, array(), Response::HTTP_OK);
    }

    public function errorResponse($errors = array(), $message = 'Request failed.')
    {
        return $this->response(false, array(), $message, array(), Response::HTTP_BAD_REQUEST);
    }
}