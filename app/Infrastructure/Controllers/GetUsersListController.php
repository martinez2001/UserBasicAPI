<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    public function __invoke():JsonResponse
    {
        return response()->json([
            'error' => "An error occurred while a petition was made"
        ], Response::HTTP_BAD_REQUEST);
    }

}
