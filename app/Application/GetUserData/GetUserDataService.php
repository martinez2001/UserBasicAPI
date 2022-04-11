<?php

namespace App\Application\GetUserData;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class GetUserDataService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserDataService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }
    /**
     * @param string $userId
     * @return bool
     * @throws Exception
     */
    public function execute(string $userId): array
    {
        $userData = $this->userDataSource->getUserDataById($userId);

        return $userData;
    }
}
