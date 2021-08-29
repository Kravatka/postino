<?php

namespace App\Console\Commands\AMQP;

use App\Components\AMQP\AMQPSender;
use Illuminate\Console\Command;

class TestAMQPSend extends Command
{
    protected $signature = 'send:amqp';

    public function handle()
    {
        $sender = new AMQPSender();

        $sender->send('Hi! Its my first amqp message', 'hello');
    }
}