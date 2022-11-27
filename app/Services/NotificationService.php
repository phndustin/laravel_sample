<?php

namespace App\Services;

use App\Models\Notification;

interface NotificationService extends GenericService {
    public function list();
    public function read(Notification $notification);
}
