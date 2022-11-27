<?php

namespace App\Notification\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notification\Events\SendEmployeeNotification;
use App\Models\User;
use Log;
use App\Notification\Supports\Firebase;
use App\Repositories\NotificationTargetRepository;
use App\Repositories\NotificationReceiverRepository;
use App\Repositories\UserDeviceRepository;
use App\Repositories\NotificationRepository;

class ListenUserNotification implements ShouldQueue
{
    private $firebase;
    private $notificationRepository;
    private $notificationTargetRepository;
    private $notificationReceiverRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        Firebase $firebase,
        NotificationRepository $notificationRepository,
        NotificationTargetRepository $notificationTargetRepository,
        NotificationReceiverRepository $notificationReceiverRepository,
        UserDeviceRepository $userDeviceRepository
    ) {
        $this->firebase = $firebase;
        $this->notificationRepository = $notificationRepository;
        $this->notificationTargetRepository = $notificationTargetRepository;
        $this->notificationReceiverRepository = $notificationReceiverRepository;
        $this->userDeviceRepository = $userDeviceRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendEmployeeNotification $event)
    {
        $notification = $event->notification;
        $devices = $this->notificationTargetRepository
            ->select('users.id as user_id', 'user_devices.device_token')
            ->join('users', 'notification_targets.notifiable_id', 'users.id')
            ->join('user_devices', 'user_devices.user_id', 'users.id')
            ->where('notification_targets.notification_id', $notification->id)
            ->where('notification_targets.notifiable_type', User::class)
            ->get();

        $this->sendDevices($devices, $notification);

        $this->notificationRepository
            ->where('id', $notification->id)
            ->where('status', 'SENDING')
            ->update([
                'status'     => 'SENT',
                'sent_at'    => now(),
                'updated_by' => 'system',
                'updated_at' => now(),
            ]);
    }

    private function sendDevices($devices, $notification)
    {
        if ($devices->count() == 0) {
            return;
        }

        $deviceTokens = $devices->pluck('device_token')->toArray();
        $report = $this->firebase->sendMulticast($deviceTokens, $notification);
        $successfulTokens = $report->validTokens();

        $successfulDevices = $this->userDeviceRepository
            ->select('user_devices.user_id')
            ->whereIn('user_devices.device_token', $successfulTokens)
            ->groupBy('user_devices.user_id')
            ->get();

        $batches = [];
        foreach($successfulDevices as $device) {
            $batches[] = [
                'notification_id' => $notification->id,
                'user_id'         => $device['user_id'],
                'created_at'      => now(),
            ];
        }
        $this->notificationReceiverRepository->insert($batches);
    }
}
