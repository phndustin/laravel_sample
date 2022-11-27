<?php

namespace App\Notification\Contracts;

use App\Models\Notification;
use App\Notification\Entities\Notification as NotificationEntity;

interface NotificationContract {
    public function push(Notification $notification);
    public function sendBroadcast(NotificationEntity $entity);
    public function sendToUser(NotificationEntity $entity);
}
