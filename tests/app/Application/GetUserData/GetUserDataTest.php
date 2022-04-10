<?php

namespace Tests\app\Application\GetUserData;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Application\UserDataSource\UserDataSource;
use App\Application\GetUserData\GetUserData;
use App\Domain\User;
use Exception;

class GetUserDataTest extends TestCase
{
    private GetUserData $getUserData;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUserData = new GetUserData($this->userDataSource);
    }
    /**
     * @test
     */
    public function user_not_found()
    {
        $userId = 999;
        $this->userDataSource
            ->expects('findById')
            ->with($userId)
            ->once()
            ->andThrow(new Exception('User not found'));

        $this->expectException(Exception::class);

        $this->getUserData->execute($userId);
    }
}
