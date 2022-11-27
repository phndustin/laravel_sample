<?php

namespace App\Repositories\Impls;

use App\Repositories\ConstantRepository;
use App\Models\Constant;

class ConstantRepositoryImpl extends GenericRepositoryImpl implements ConstantRepository {
    public function __construct(Constant $model) {
        $this->model = $model;
    }
}
