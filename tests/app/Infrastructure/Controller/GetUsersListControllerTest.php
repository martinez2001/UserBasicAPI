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
            ->expects('getUsersList')
            ->with()
            ->once()
            ->andThrow(new Exception('An error occurred while a petition was made'));

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)->assertExactJson(['error' => "An error occurred while a petition was made"]);
    }

    /**
     * @test
     */
    public function there_are_no_users_in_list(){
        $empty_users_list = array();

        $this->userDataSource
            ->expects('getUsersList')
            ->with()
            ->once()
            ->andReturn($empty_users_list);

            $response = $this->get('/api/users/list');

            $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list' => array()]);
    }

    /**
     * @test
     */
    public function list_with_3_users_returned(){
        $userId1 = 1;
        $users_list[] = $userId1;

        $userId2 = 2;
        $users_list[] = $userId2;

        $userId3 = 3;
        $users_list[] = $userId3;

        $this->userDataSource
            ->expects('getUsersList')
            ->with()
            ->once()
            ->andReturn($users_list);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson(['list' => array($userId1,$userId2,$userId3)]);
    }






}
