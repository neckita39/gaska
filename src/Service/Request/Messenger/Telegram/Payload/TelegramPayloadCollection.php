<?php

namespace App\Service\Request\Messenger\Telegram\Payload;

use Traversable;

class TelegramPayloadCollection implements \IteratorAggregate
{
	private array $payloads = [];

	public function __construct(TelegramPayload ...$payload)
	{
		$this->payloads = $payload;
	}


	public function getIterator(): Traversable
	{
		return new \ArrayIterator($this->payloads);
	}

	public function add(TelegramPayload $payload): self
	{
		$this->payloads[] = $payload;
		return $this;
	}

	public function isEmpty(): bool
	{
		return empty($this->payloads);
	}

	public function toArray(): array
	{
		$result = [];
		foreach ($this->payloads as $payload)
		{
			$result[] = $payload->toArray();
		}

		return $result;
	}
}