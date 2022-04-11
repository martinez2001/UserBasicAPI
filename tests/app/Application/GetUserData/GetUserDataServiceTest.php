<?php

namespace Tests\app\Application\GetUserData;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Application\UserDataSource\UserDataSource;
use App\Application\GetUserData\GetUserDataService;
use App\Domain\User;
use Exception;

class GetUserDataServiceTest extends TestCase
{
    private GetUserDataService $getUserData;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUserData = new GetUserDataService($this->userDataSource);
    }
    /**
     * @test
     */
    public function user_not_found()
    {
        $userId = 999;
        $this->userDataSource
            ->expects('getUserDataById')
            ->with($userId)
            ->once()
            ->andThrow(new Exception('User not found'));

        $this->expectException(Exception::class);

        $this->getUserData->execute($userId);
    }
    /**
     * @test
     */
    public function user_found()
    {
        $userId = 1;
        $user = new User($userId, 'hola@email.com');
        $this->userDataSource
            ->expects('getUserDataById')
            ->with($userId)
            ->once()
            ->andReturn($user);

        $this->expectException(Exception::class);

        $this->getUserData->execute($userId);
    }
}
