<?php

namespace App\Notification\Entities;

class Notification {
    private $type;
    private $title;
    private $content;
    private $body;
    private $data;
    private $status;
    private $scheduleTime;
    private $sender;
    private $targets;
    private $notification;
    private $untouchDB;
    private $sentAt;

    private function __construct() {
    }

    public static function builder() {
        return new self();
    }

    public function type($type) {
        $this->type = $type;
        return $this;
    }

    public function title($title) {
        $this->title = $title;
        return $this;
    }

    public function content($content) {
        $this->content = $content;
        return $this;
    }

    public function body($body) {
        $this->body = $body;
        return $this;
    }

    public function data($data) {
        $this->data = $data;
        return $this;
    }

    public function status($status) {
        $this->status = $status;
        return $this;
    }

    public function scheduleTime($scheduleTime) {
        $this->scheduleTime = $scheduleTime;
        return $this;
    }

    public function sender($sender) {
        $this->sender = $sender;
        return $this;
    }

    public function targets($targets) {
        $this->targets = $targets;
        return $this;
    }

    public function notification($notification) {
        $this->notification = $notification;
        return $this;
    }

    public function untouchDB($untouchDB) {
        $this->untouchDB = $untouchDB;
        return $this;
    }

    public function sentAt($sentAt) {
        $this->sentAt = $sentAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getScheduleTime()
    {
        return $this->scheduleTime;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getTargets()
    {
        return $this->targets;
    }

    /**
     * @return mixed
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @return mixed
     */
    public function getUntouchDB()
    {
        return $this->untouchDB;
    }

    /**
     * @return mixed
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }
}
