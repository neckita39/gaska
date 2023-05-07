<?php

namespace App\Service\Request\AI\OpenAI\Gpt;

use App\Internal\AI\OpenAI\Gpt;
use App\Internal\Messenger\Telegram\MessageData;
use OpenAI;
use OpenAI\Client;
use OpenAI\Contracts\ResponseContract;

abstract class GptRequest
{
	protected Client $client;
	protected ?ResponseContract $requestResult = null;
	public function __construct(
		protected readonly Gpt         $gpt,
		protected readonly MessageData $payload,
	)
	{
		$this->client = OpenAI::factory()
			->withApiKey($this->gpt->getToken())
			->make()
		;
	}

	protected function getModel(): string
	{
		return 'gpt-3.5-turbo';
	}
}