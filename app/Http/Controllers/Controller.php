<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param int    $status
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function responseFailed(int $status = Response::HTTP_INTERNAL_SERVER_ERROR, string $message = '')
    {
        return response()->json(
            [
                'failed' => true,
                'message' => $message
            ],
            $status
        );
    }

    /**
     * @param int $status
     * @param string $message
     * @param $data
     *
     * @return JsonResponse
     */
    protected function responseSuccess(int $status = Response::HTTP_OK, string $message = '', $data = null)
    {
        return response()->json(
            [
                'success' => true,
                'message' => $message,
                'data' => $data
            ],
            $status
        );
    }
}
