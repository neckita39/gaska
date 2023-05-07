<?php

namespace App\Service\Request\Messenger\Telegram\Payload;

abstract class TelegramPayload
{
	public function __construct(
		protected readonly string $payload
	)
	{}

	abstract public function getFormat(): string;
	public function getPayload(): string
	{
		return $this->payload;
	}

	public function toArray(): array
	{
		return ['format' => $this->getFormat(), 'payload' => $this->getPayload()];
	}
}