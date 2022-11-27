<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Http\Resources\ApiCollection;
use App\Http\Resources\ApiResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    private $notificationService;

    public function __construct(
        NotificationService $notificationService
    ) {
        $this->notificationService = $notificationService;
    }

    public function index() {
        $data = $this->notificationService->list();
        return new ApiCollection($data);
    }

    public function read(Notification $notification) {
        $this->notificationService->read($notification);
        return new ApiResource([]);
    }
}
