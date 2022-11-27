<?php

namespace App\Repositories\Impls;

use App\Repositories\NotificationRepository;
use App\Models\Notification;

class NotificationRepositoryImpl extends GenericRepositoryImpl implements NotificationRepository {
    public function __construct(Notification $model) {
        $this->model = $model;
    }
}
