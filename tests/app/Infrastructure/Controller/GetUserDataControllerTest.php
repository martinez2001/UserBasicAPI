<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUserDataControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function user_with_given_id_does_not_exist()
    {
        $this->userDataSource
            ->expects('getUserDataById')
            ->with('999')
            ->once()
            ->andThrow(new Exception('User not found'));

        $response = $this->get('/api/users/999');

        $response->assertExactJson(['error' => 'user does not exist']);
    }
    /**
     * @test
     */
    public function user_with_given_id_exists()
    {
        $userData = ['1', 'manolo@gmail.com'];
        $this->userDataSource
            ->expects('getUserDataById')
            ->with('1')
            ->once()
            ->andReturn($userData);

        $response = $this->get('/api/users/1');

        $response->assertExactJson(['user' => $userData]);
    }

    /**
     * @test
     */
    public function petition_gives_generic_error()
    {
        $this->userDataSource
            ->expects('getUserDataById')
            ->with('a')
            ->once()
            ->andThrow(new Exception('Petition error'));

        $response = $this->get('/api/users/a');

        $response->assertExactJson(['error' => "Petition error"]);
    }
}
