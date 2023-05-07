<?php

namespace App\Service\Request\Messenger\Telegram;

use App\Internal\Messenger\Telegram\Bot\TelegramBot;
use App\Internal\Messenger\Telegram\MessageData;
use App\Service\Request\Messenger\Telegram\Payload\TelegramPayload;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TelegramRequest
{
	protected const URL = 'https://api.telegram.org/bot';
	protected ?ResponseInterface $requestResult = null;
	protected TelegramBot $bot;

	public function __construct(
		protected readonly MessageData         $messageData,
		protected readonly TelegramPayload     $message,
		protected readonly HttpClientInterface $client,
	)
	{
		$this->bot = TelegramBot::getInstance();
	}

	protected function getRequestPayload(): TelegramPayload
	{
		return $this->message;
	}

	protected function getRequestCommand(): string
	{
		switch ($this->getRequestPayload()->getFormat())
		{
			case 'photo':
				return 'sendPhoto';
			default:
				return 'sendMessage';
		}
	}

	protected function getUrl(): string
	{
		return static::URL;
	}

	public function send(bool $execute = false): void
	{
		$format = $this->getRequestPayload()->getFormat();
		$requestMessage = str_replace(
			['%bot_name%', '%user_name%'],
			[$this->bot->getName(), $this->messageData->getUser()->getLogin()],
			$this->getRequestPayload()->getPayload()
		);
		$request = [
			'chat_id' => $this->messageData->getChat()->getId(),
			$format => $requestMessage
		];

		$token = $this->bot->getToken();
		$command = $this->getRequestCommand();
		$requestPayload = http_build_query($request);
		$url = $this->getUrl();
		$this->requestResult = $this->client->request(
			'GET',
			"$url$token/$command?$requestPayload"
		);

		$execute && $this->requestResult->getStatusCode();
	}
}