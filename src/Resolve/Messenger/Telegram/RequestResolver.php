<?php

namespace App\Resolve\Messenger\Telegram;

use App\Internal\Messenger\Telegram\MessageData;
use App\Internal\Messenger\Telegram\Item\TelegramChat;
use App\Internal\Messenger\Telegram\Item\TelegramMessage;
use App\Internal\Messenger\Telegram\Item\TelegramMessageData;
use App\Internal\Messenger\Telegram\Item\TelegramUser;
use App\Resolve\Messenger\Resolver;
use Symfony\Component\HttpFoundation\Request;

class RequestResolver implements Resolver
{
	public function resolve(Request $request): MessageData
	{
		$data = $request->toArray();
		$chat = new TelegramChat($data['message']['chat']['id'] ?? 0);
		$message = new TelegramMessage($data['message']['text'] ?? '');
		$user = new TelegramUser($data['message']['chat']['username'] ?? $data['message']['from']['username'] ?? '');

		return new TelegramMessageData($chat, $message, $user);
	}
}