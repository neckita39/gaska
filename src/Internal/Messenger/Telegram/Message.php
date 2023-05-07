<?php

namespace App\Internal\Messenger\Telegram;


interface Message
{
	public function getText(bool $toLower = true): string;
	public function getCommand(): Command;
	public function getCleanText(): string;
}