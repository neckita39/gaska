<?php

namespace App\Internal\Messenger\Telegram\Item;

use App\Internal\Messenger\Telegram\Chat;
use App\Internal\Messenger\Telegram\Message;
use App\Internal\Messenger\Telegram\MessageData;
use App\Internal\Messenger\Telegram\User;

class TelegramMessageData implements MessageData
{
	public function __construct(
		private readonly Chat $chat,
		private readonly Message $message,
		private readonly User $user,
	)
	{
	}

	public function getChat(): Chat
	{
		return $this->chat;
	}

	public function getMessage(): Message
	{
		return $this->message;
	}

	public function getUser(): User
	{
		return $this->user;
	}
}