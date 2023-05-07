<?php

namespace App\Internal\Messenger\Telegram\Item\Command;

use App\Internal\Messenger\Telegram\Item\TelegramCommand;

class DefaultCommand extends TelegramCommand
{

	public function getText(): string
	{
		return 'default';
	}
}