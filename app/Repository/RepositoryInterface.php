<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    function find(array $conditions = [], array $with = []): ?Model;
    function save(array $data = [], $model = null): ?Model;
}
