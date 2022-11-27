<?php

namespace App\Repositories\Impls;

use App\Repositories\Google2faQrcodeRepository;
use App\Models\Google2faQrcode;

class Google2faQrcodeRepositoryImpl extends GenericRepositoryImpl implements Google2faQrcodeRepository {
    public function __construct(Google2faQrcode $model) {
        $this->model = $model;
    }
}
