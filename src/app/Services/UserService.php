<?php
namespace App\Services;

use App\User;
use App\WinWin\Exceptions\EntityNotFound;

class UserService implements IUserService
{
    public function all()
    {
        return User::all();
    }

    public function getById(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new EntityNotFound;
        }

        return $user;
    }

    public function insert(array $data)
    {
        return User::create($data);
    }

    public function update(string $id, array $data)
    {
        $user = $this->getById($id);
        $user->fill($data);
        $user->save();

        return $user;
    }

    public function delete(string $id)
    {
        $user = $this->getById($id);
        $user->delete();
    }
}
