<?php

namespace App\Internal\Messenger\Telegram\Item\Command;

use App\Internal\Messenger\Telegram\Item\TelegramCommand;

class AIImageCommand extends TelegramCommand
{
	public function getText(): string
	{
		return 'ai image';
	}
}