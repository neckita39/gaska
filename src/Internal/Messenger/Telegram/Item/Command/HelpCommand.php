<?php

namespace App\Internal\Messenger\Telegram\Item\Command;

use App\Internal\Messenger\Telegram\Item\TelegramCommand;

class HelpCommand extends TelegramCommand
{

	public function getText(): string
	{
		return 'help';
	}
}