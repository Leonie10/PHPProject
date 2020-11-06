<?php

class Message {

    public const MINUSERNAME = 2;
    public const MINMESSAGE = 3;

    public $username;
    public $message;
    public $date;

    public function __construct(string $username, string $message, DateTime $date)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date;

    }



    public function isValid () : bool {
        return strlen($this->username) > self::MINUSERNAME && strlen($this->message) > self::MINMESSAGE;
    }

    public function toJSON () {
        $file = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'messages';
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $datas =  json_encode([
            "username" => $this->username,
            "message" => $this->message,
            "date" => $this->date->format('H:i:s')
        ]);
        file_put_contents($file,$datas.PHP_EOL, FILE_APPEND);
    }
    public function getJSONContent (){
        $file = dirname(__DIR__).DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'messages';
        $datas = file_get_contents($file);
        $messagesJSON = explode("\n", $datas);
        $msg = [];
        for($x = 0; $x < count($messagesJSON); $x++){
            $msg[$x]= json_decode($messagesJSON[$x],true);
        }

        return $msg;
        
    }
    

    


}
