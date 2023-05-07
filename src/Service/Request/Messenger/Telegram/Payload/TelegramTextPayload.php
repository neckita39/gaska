<?php

namespace App\Service\Request\Messenger\Telegram\Payload;

class TelegramTextPayload extends TelegramPayload
{
	public function getFormat(): string
	{
		return 'text';
	}
}