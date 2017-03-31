<?php

namespace ItPoet\Mymsg;

class MymsgApi{

    public $apiKey = null;
    public $protocol = 'https';
    public $userOrCode = null;
    public $message = null;
    public $subject = null;
    public $replyTo = '';
    public $fromAddress = '';
    public $fromTitle = '';
    public $email1 = '';
    public $email2 = '';
    public $telegram = '';

    public function sendToUser()
    {
        $url = $this->protocol.'://mymsg.pw/api/v1/sendtouser';
        $params = array(
            'user_or_code' => $this->userOrCode,
            'subject' => $this->subject,
            'message' => $this->message,
        );
        return $this->send($url, $params);
    }

    public function sendTo()
    {
        $url = $this->protocol.'://mymsg.pw/api/v1/sendto';
        $params = array(
            'email1' => $this->email1,
            'email2' => $this->email2,
            'telegram' => $this->telegram,
            'replyto' => $this->replyTo,
            'froma' => $this->fromAddress,
            'fromt' => $this->fromTitle,
            'subject' => $this->subject,
            'message' => $this->message,
        );
        return $this->send($url, $params);
    }

    private function send($url, $params)
    {
        $result = @file_get_contents($url, false, stream_context_create(array(
            'http' => array(
                'timeout' => 10,
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded'."\r\n".'X-Authorization: '.$this->apiKey,
                'content' => http_build_query($params)
            )
        )));
        return $result;
    }
}
