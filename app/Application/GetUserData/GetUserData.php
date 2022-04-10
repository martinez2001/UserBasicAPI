<?php

namespace App\Application\GetUserData;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class GetUserData
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserData constructor.
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
    public function execute(string $userId): bool
    {
        $user = $this->userDataSource->findById($userId);

        return $user->getData();
    }
}
