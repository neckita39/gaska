<?php

namespace App\Internal\Messenger\Telegram;

interface Command
{
	public function getText(): string;
}