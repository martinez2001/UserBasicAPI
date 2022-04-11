<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use App\Application\UsersList\UsersListService;
use Exception;

class GetUsersListController extends BaseController
{
    private $usersListService;
    public function __construct(UsersListService $usersListService)
    {
        $this->usersListService = $usersListService;
    }

    public function __invoke():JsonResponse
    {
        try{
            $usersList = $this->usersListService->execute();
        }catch(Exception $exception){
            return response()->json([
                'error' => "An error occurred while a petition was made"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'list' => $usersList
        ], Response::HTTP_OK);
    }

}
