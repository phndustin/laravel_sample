<?php

namespace App\Notification\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notification\Events\SendBroadcast;
use App\User;
use App\Notification\Supports\Firebase;
use App\Repositories\NotificationTargetRepository;
use App\Repositories\NotificationReceiverRepository;
use App\Repositories\UserDeviceRepository;
use App\Repositories\NotificationRepository;
use App\Notification\Traits\DeviceTrait;

class ListenBroadcastNotification implements ShouldQueue
{
    use DeviceTrait;

    const CHUNK = 1000;

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
    public function handle(SendBroadcast $event)
    {
        $notification = $event->notification;
        $count = $this->userDeviceRepository
            ->join('users', 'users.id', 'user_devices.user_id')
            ->join('employer', 'employer.user_id', 'users.id')
            ->where('users.platform', 'EMPLOYEE')
            ->where('employer.is_active', true)
            ->count();

        $loop = intval($count / self::CHUNK) + 1;
        for ($i = 0; $i < $loop; $i++) {
            $offset = $i * self::CHUNK;
            $devices = $this->userDeviceRepository
                ->select('users.id as user_id', 'user_devices.device_token')
                ->join('users', 'users.id', 'user_devices.user_id')
                ->where('users.platform', 'EMPLOYEE')
                ->orderBy('user_devices.id')
                ->offset($offset)
                ->limit(self::CHUNK)
                ->get();

            $this->sendDevices($devices, $notification);
        }

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
}
