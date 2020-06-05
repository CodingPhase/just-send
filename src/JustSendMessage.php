<?php

namespace CodingPhase\JustSend;
use Illuminate\Support\Arr;

class JustSendMessage
{
    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $to = '';

    /**
     * The phone number the message should be sent from.
     *
     * @var string
     */
    public $from = 'Info';

    /**
     * The message content.
     *
     * @var string
     */
    public $content = '';

    /**
     * Create a new message instance.
     *
     * @param  string $content
     *
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * @param  string $content
     */
    public function __construct($content = '')
    {
        $this->content = $content;
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     *
     * @return $this
     */
    public function content($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the phone number the message should be sent to.
     *
     * @param $to
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the Sender name the message should be sent from.
     *
     * @param $from
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }
}
