<?php

namespace App\Service\Request\Messenger\Telegram\Payload\Message;

class ThanksMessage implements Message
{

	public function getText(): string
	{
		return 'Не за что, кожаный мешок';
	}
}