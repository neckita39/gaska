<?php

namespace App\Internal\Messenger\Telegram\Bot;

class TelegramBot
{
	private static ?self $instance = null;

	private function __construct(
		private readonly string $token
	)
	{}

	public static function getInstance(): self
	{
		if (is_null(static::$instance))
		{
			static::$instance = new self($_ENV['TELEGRAM_TOKEN']);
		}

		return static::$instance;
	}

	public function getToken(): string
	{
		return $this->token;
	}

	public function getName(): string
	{
		return mb_strtolower('Гаська');
	}
}