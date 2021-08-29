<?php


namespace App\Components\AMQP;


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class AMQPSender
{
    public $connection;
    public $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    /**
     * @param $msg
     * @param $q
     * @throws \Exception
     */
    public function send($msg, $q)
    {
        $this->channel->queue_declare($q, false, false, false, false);

        $msg = new AMQPMessage($msg);
        $this->channel->basic_publish($msg, '', 'hello');

        $this->channel->close();
        $this->connection->close();
    }
}