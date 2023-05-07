<?php

namespace App\Internal\AI\OpenAI;

class Gpt
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
			static::$instance = new self($_ENV['GPT_TOKEN']);
		}

		return static::$instance;
	}
	public function getToken(): string
	{
		return $this->token;
	}
}