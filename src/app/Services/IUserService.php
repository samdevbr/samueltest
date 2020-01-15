<?php
namespace App\Services;

interface IUserService
{
    public function all();
    public function getById(string $id);
    public function insert(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);
}
