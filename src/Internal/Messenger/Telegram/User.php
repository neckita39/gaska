<?php

namespace App\Internal\Messenger\Telegram;

interface User
{
	public function getLogin(): string;
}