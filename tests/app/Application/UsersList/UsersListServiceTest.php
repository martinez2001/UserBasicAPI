<?php

use App\Application\UserDataSource\UserDataSource;
use App\Application\UsersList\UsersListService;
use App\Domain\User;
//use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class UsersListServiceTest extends TestCase
{
    private UsersListService $usersListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->usersListService = new UsersListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function empty_list_of_users()
    {
        $emptyList = array();

        $this->userDataSource
            ->expects('getUsersList')
            ->with()
            ->once()
            ->andReturn($emptyList);

        $usersList = $this->usersListService->execute();

        $this->assertEquals(array(), $usersList);


    }
}
