<?php

namespace App\Service\Request\Messenger\Telegram\Payload\Message;

class DefaultMessage implements Message
{

	public function getText(): string
	{
		return 'Привет, %user_name%! Махнем по писярику?';
	}
}