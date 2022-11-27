<?php

namespace App\Notification\Contracts\Consumers;

use App\Notification\Contracts\NotificationContract;
use App\Repositories\NotificationRepository;
use App\Repositories\NotificationTargetRepository;
use App\Repositories\NotificationReceiverRepository;
use App\Models\Notification;
use App\Models\User;
use App\Notification\Events\SendUserNotification;
use App\Notification\Events\SendBroadcast;
use App\Notification\Entities\Notification as NotificationEntity;
use App\Exceptions\BusinessException;

class NotificationConsumer implements NotificationContract {
    private $notificationRepository;
    private $notificationTargetRepository;
    private $notificationReceiverRepository;

    public function __construct(
        NotificationRepository $notificationRepository,
        NotificationTargetRepository $notificationTargetRepository,
        NotificationReceiverRepository $notificationReceiverRepository
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->notificationTargetRepository = $notificationTargetRepository;
        $this->notificationReceiverRepository = $notificationReceiverRepository;
    }

    /**
     * [send description]
     * @param  Array        $receivers
     * @param  Notification $entity
     */
    public function push(Notification $notification) {
        if ($notification->type == 'BROADCAST') {
            event(new SendBroadcast($notification));
            return;
        }

        $countUser = $this->notificationTargetRepository->countByNotificationIdAndNotifiableType($notification->id, User::class);
        if ($countUser > 0) {
            event(new SendUserNotification($notification));
        }
    }

    public function sendBroadcast(NotificationEntity $entity) {
        return $this->sendToTarget($entity, 'BROADCAST');
    }

    public function sendToUser(NotificationEntity $entity) {
        return $this->sendToTarget($entity, User::class);
    }

    private function sendToTarget(NotificationEntity $entity, $targetType) {
        $notification = null;
        if (!$entity->getUntouchDB()) {
            if (!$entity->getNotification()) {
                $notification = $this->notificationRepository->create([
                    'type'          => $entity->getType(),
                    'title'         => $entity->getTitle(),
                    'content'       => $entity->getContent(),
                    'body'          => $entity->getBody(),
                    'data'          => $entity->getData() ? json_encode($entity->getData()) : null,
                    'status'        => $entity->getStatus(),
                    'schedule_time' => $entity->getScheduleTime(),
                    'sent_at'       => $entity->getSentAt(),
                    'created_by'    => $entity->getSender(),
                    'updated_by'    => $entity->getSender(),
                ]);
            } else {
                $notification = $entity->getNotification();
                 $this->notificationRepository
                    ->where('id', $notification->id)
                    ->update([
                        'type'          => $entity->getType(),
                        'title'         => $entity->getTitle(),
                        'content'       => $entity->getContent(),
                        'body'          => $entity->getBody(),
                        'data'          => $entity->getData() ? json_encode($entity->getData()) : null,
                        'status'        => $entity->getStatus(),
                        'schedule_time' => $entity->getScheduleTime(),
                        'sent_at'       => $entity->getSentAt(),
                        'updated_by'    => $entity->getSender(),
                    ]);
                $notification->refresh();
            }
        }

        if (!$notification) {
            throw new BusinessException('notification.not_found');
        }

        if ($this->canInsertTarget($entity, $targetType)) {
            // Reset target
            $this->notificationTargetRepository->where('notification_id', $notification->id)->delete();

            // Insert new targets
            $targetBatches = [];
            foreach($entity->getTargets() as $target) {
                $companyId = $target['company_id'] ?? null;
                $targetBatches[] = [
                    'notifiable_type' => $targetType,
                    'notifiable_id'   => $target['id'],
                    'notification_id' => $notification->id,
                    'company_id'      => $companyId,
                ];
            }
            $this->notificationTargetRepository->insert($targetBatches);
        }

        // Push notification
        if ($notification->status == 'SENDING') {
            $this->push($notification);
        }
        return $notification;
    }

    private function canInsertTarget(NotificationEntity $entity, $targetType) {
        if ($targetType == 'BROADCAST') {
            return false;
        }
        if ($entity->getUntouchDB()) {
            return false;
        }
        return true;
    }
}
