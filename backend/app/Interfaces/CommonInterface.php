<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface CommonInterface
{
    public function store(array $data): Model;
    public function all(): Builder;
    public function fetch(int $id): Model | NULL;
    public function update(int $id, array $updatedData): bool;
    public function delete(int $id): bool;
}
