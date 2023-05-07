<?php

namespace App\Internal\Messenger\Telegram\Item;

use App\Internal\Messenger\Telegram\User;

class TelegramUser implements User
{
	public function __construct(
		private readonly string $name
	){
	}
	public function getLogin(): string
	{
		return $this->name;
	}
}