<?php

namespace App\Service\Request\Messenger\Telegram\Payload\Message;

interface Message
{
	public function getText(): string;
}