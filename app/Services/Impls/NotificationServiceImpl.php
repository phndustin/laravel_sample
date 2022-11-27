<?php

namespace App\Services\Impls;

use App\Services\NotificationService;
use App\Repositories\NotificationRepository;
use App\Models\Notification;
use App\Repositories\NotificationReceiverRepository;
use Notification as Messaging;
use App\Notification\Entities\Notification as NotificationEntity;

class NotificationServiceImpl extends GenericServiceImpl implements NotificationService {
    private $notificationRepository;
    private $notificationReciverRepository;

    public function __construct(
        NotificationRepository $notificationRepository,
        NotificationReceiverRepository $notificationReciverRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->notificationReciverRepository = $notificationReciverRepository;
    }

    public function list() {
        $user = auth()->user();

        $notifications = $this->notificationRepository
            ->select('notifications.*', 'notification_receivers.read_at')
            ->join('notification_receivers', 'notifications.id', 'notification_receivers.notification_id')
            ->where('notification_receivers.receiver_id', $user->id)
            ->orderBy('notifications.id', 'desc')
            ->paginate();

        return $notifications;
    }

    public function create($params) {
    }

    public function read(Notification $notification) {
        $user = auth()->user();

        $notification->read_at = now();
        $notification->updated_by = $user->id;
        $notification->save();
    }

    public function testSending() {
        $title    = 'title';
        $body     = 'body';
        $content  = 'content';
        $receiver = auth()->user();

        $message = NotificationEntity::builder()
            ->type('NOTICE')
            ->title($title)
            ->content($content)
            ->body($body)
            ->status('SENDING')
            ->targets([['id' => $receiver->id]]);

        Messaging::sendToUser($message);
    }
}
