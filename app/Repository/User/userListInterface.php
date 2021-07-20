<?php

namespace App\Repository\User;

interface userListInterface
{
    public function find($id);
    public function getAll();
    public function store($attributes);
    public function update($attributes,$id);
    public function delete($id);
}