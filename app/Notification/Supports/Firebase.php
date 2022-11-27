<?php

namespace App\Notification\Supports;

use App\Models\Notification;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Factory;
use App\Exceptions\BusinessException;

class Firebase
{
    // https://firebase-php.readthedocs.io/en/stable/cloud-messaging.html#send-messages-to-topics
    const MAX_SUBSCRIBE = 1000;
    const MAX_REGISTRATION = 500;

    private $factory;

    public function __construct() {
        $this->factory = (new Factory())
            ->withProjectId(config('firebase.project_id'))
            ->withServiceAccount(config('firebase.credentials'));
    }

    /**
     * Send to topic (max 1000)
     * @param  Array        $deviceTokens
     * @param  Notification $notification
     * @return Array
     */
    public function sendTopic($deviceTokens, Notification $notification)
    {
        if (count($deviceTokens) == 0) {
            return;
        }

        if (count($deviceTokens) > self::MAX_SUBSCRIBE) {
            throw new BusinessException('firebase.topic_max_token', 'Max tokens is 1000');
        }
        // Log::debug('send device ' . print_r($deviceTokens, true));

        $topic = sprintf('topic-%s', $notification->id);

        $_notification = [
            'title' => $notification->title,
            'body'  => $notification->content,
        ];

        $data = $this->appendData($notification);
        $message = CloudMessage::fromArray([
            'topic'        => $topic,
            'notification' => $_notification,
            'data'         => $data,
        ]);

        $messaging = $this->factory->createMessaging();

        $result = $messaging->subscribeToTopic($topic, $deviceTokens);
        $response = $messaging->send($message);
        $messaging->unsubscribeFromTopic($topic, $deviceTokens);

        $reports = [
            'success' => [],
            'fail' => [],
        ];
        foreach($result[$topic] as $deviceToken => $status) {
            if ($status == 'OK') {
                $reports['success'][] = $deviceToken;
            } else {
                $reports['fail'][] = $deviceToken;
            }
        }
        return $reports;
    }

    /**
     * Send to multiple devices (max 500 devices)
     * @param  Array               $deviceTokens
     * @param  Notification        $notification
     * @return MulticastSendReport $report
     */
    public function sendMulticast($deviceTokens, Notification $notification)
    {
        if (count($deviceTokens) > self::MAX_REGISTRATION) {
            throw new BusinessException('firebase.multicast_max_token', 'Max tokens is 500');
        }

        $_notification = [
            'title' => $notification->title,
            'body'  => $notification->content,
        ];

        $data = $this->appendData($notification);
        $message = CloudMessage::fromArray([
            'notification' => $_notification,
            'data'         => $data,
        ]);

        $messaging = $this->factory->createMessaging();
        return $messaging->sendMulticast($message, $deviceTokens);
    }

    /**
     * Send to specific devices
     * @param  string       $deviceToken
     * @param  Notification $notification
     * @return Array
     */
    public function send($deviceToken, Notification $notification)
    {
        $_notification = [
            'title' => $notification->title,
            'body'  => $notification->content,
        ];

        $data = $this->appendData($notification);
        $message = CloudMessage::fromArray([
            'token'        => $deviceToken,
            'notification' => $_notification,
            'data'         => $data,
        ]);

        $messaging = $this->factory->createMessaging();
        return $messaging->send($message);
    }

    private function appendData($notification) {
        $data = ['notification_id' => $notification->id];
        if ($notification->data) {
            if (is_string($notification->data)) {
                $notification->data = json_decode($notification->data, true);
            }
            $data = array_merge($notification->data, $data);
        }
        return $data;
    }
}