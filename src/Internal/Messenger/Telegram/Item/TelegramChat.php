<?php

namespace App\Internal\Messenger\Telegram\Item;

use App\Internal\Messenger\Telegram\Chat;

class TelegramChat implements Chat
{
	public function __construct(
		private readonly int $id
	)
	{
	}
	public function getId(): int
	{
		return $this->id;
	}
}