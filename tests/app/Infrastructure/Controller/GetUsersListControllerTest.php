<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUsersListControllerTest extends TestCase
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
    public function error_occurs_when_asked_for_users_list()
    {
        $this->userDataSource
            ->expects('returnUsersList')
            ->with()
            ->never()
            ->andThrow(new Exception('An error occurred while a petition was made'));

        $response = $this->get('/api/users/list');

        $response->assertExactJson(['error' => 'An error occurred while a petition was made']);
    }
}
