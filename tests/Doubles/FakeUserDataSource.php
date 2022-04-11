<?php
namespace Tests\app\Doubles;

class FakeUserDataSource implements UserDataSource
{
    public function findByEmail(string $email): User{
        return new User('1', 'manolo@gmail.com');
    }
    public function getUserDataById(string $userId): array{
        if ($userId == '1')
            return (['1', 'usuario@gmail.com']);
        return [];
    }
    public function getUsersList(): array{
        $numRand = rand(1,2);
        if($numRand==1){
            return array();
        }
        else {
            return array(1, 2, 3);
        }
    }
}
