<?php

namespace CodingPhase\JustSend\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($exception)
    {
        return new static($exception->getMessage());
    }

    public static function missingRecipient()
    {
        return new static("Missing Recipient");
    }
}
