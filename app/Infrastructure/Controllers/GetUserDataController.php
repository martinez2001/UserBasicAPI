<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUserData\GetUserDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Routing\Controller as BaseController;

class GetUserDataController extends BaseController
{
    private GetUserDataService $getUserDataService;
    public function __construct(GetUserDataService $getUserDataService){
        $this->getUserDataService = $getUserDataService;
    }

    public function __invoke(string $userId): JsonResponse
    {
        try{
            $userData = $this->getUserDataService->execute($userId);
        }catch(Exception $exception) {
            if ($exception->getMessage() === 'User not found') {
                return response()->json([
                    'error' => "user does not exist"
                ], Response::HTTP_BAD_REQUEST);
            }
            else {
                return response()->json([
                    'error' => "petition error"
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        return response()->json([
            'user' => $userData
        ], Response::HTTP_OK);
    }
}
