<?php

namespace CodingPhase\JustSend;

use Skylen\JustSend\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class JustSendChannel
{
    protected $justSend;

    /**
     * SMSApiChannel constructor.
     * @param JustSend $justSend
     */
    public function __construct(JustSend $justSend)
    {
        $this->justSend = $justSend;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \Skylen\JustSend\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toJustSend($notifiable);

        if (!$message->to) {
            if ($to = $notifiable->routeNotificationFor('justSend')) {
                $message->to($to);
            }
            if (empty($to)) {
                throw CouldNotSendNotification::missingRecipient();
            }
        }

        try {
            $this->justSend->send($message);
        } catch (\Exception $exception) {
            \Log::info($exception->getMessage());
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
