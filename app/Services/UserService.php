<?php

namespace App\Services;

interface UserService extends GenericService {
    public function getMe();
}
