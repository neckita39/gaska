<?php

namespace App\Service\Request\Messenger\Telegram\Payload;

class TelegramImagePayload extends TelegramPayload
{
	public function getFormat(): string
	{
		return 'photo';
	}
}