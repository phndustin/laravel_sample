<?php

namespace App\Notification\Traits;

use DB;
use App\Exceptions\BusinessException;

trait DeviceTrait
{
    private function sendDevices($devices, $notification) {
        if ($devices->count() == 0) {
            return;
        }

        if (!$this->notificationReceiverRepository || !$this->firebase) {
            throw new BusinessException('binding.error');
        }

        $deviceTokens = $devices->pluck('device_token')->toArray();
        if (count($deviceTokens) == 0) {
            return;
        }

        $reports = $this->firebase->sendTopic($deviceTokens, $notification);

        $successfulDevices = $reports['success'];

        // Lấy những user chưa gửi để update log
        $placeholders = implode(',', array_fill(0, count($successfulDevices), '?'));
        $params = array_merge($successfulDevices, [$notification->id]);
        $untouchUsers = DB::select('
                select `u`.`user_id`
                from (select * from user_devices where device_token in (' . $placeholders . ')) u
                left join (select * from notification_receivers where notification_id = ?) n on `n`.`user_id` = `u`.`user_id`
                where `n`.`user_id` is null
                group by `u`.`user_id`
            ', $params);

        $batches = [];
        foreach($untouchUsers as $item) {
            $batches[] = [
                'notification_id' => $notification->id,
                'user_id'         => $item->user_id,
                'created_at'      => now(),
            ];
        }
        if (count($batches) > 0) {
            $this->notificationReceiverRepository->insert($batches);
        }
    }
}
