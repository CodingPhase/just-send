<?php

namespace CodingPhase\JustSend;

use GuzzleHttp\Client;

class JustSend
{
    protected $apiKey;
    protected $type;
    protected $from;
    protected $url;

    public function __construct($apiKey, $url, $type, $from)
    {
        $this->apiKey = $apiKey;
        $this->url = $url;
        $this->type = $type;
        $this->from = $from;
    }

    /**
     * @param JustSendMessage $message
     * @return mixed
     */
    public function send(JustSendMessage $message)
    {
        $client = new Client([
            'base_uri' => $this->url,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'App-Key' => $this->apiKey
            ],

        ]);
        $sendData = [
            "message" => $message->content,
            "from" => $message->from ? $message->from : $this->from,
            "doubleEncode" => true,
            'bulkVariant' => $this->type,
            "to" => $message->to

        ];
        return $client->post('v2/message/send', [
                'json' => $sendData,
            ]
        );
    }
}
