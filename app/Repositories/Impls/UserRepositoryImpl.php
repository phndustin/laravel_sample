<?php

namespace App\Repositories\Impls;

use App\Repositories\UserRepository;
use App\Models\User;

class UserRepositoryImpl extends GenericRepositoryImpl implements UserRepository {
    public function __construct(User $model) {
        $this->model = $model;
    }
}
