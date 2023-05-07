<?php

namespace App\Service\Request\AI\OpenAI\Gpt;

class GptTextRequest extends GptRequest
{
	public function send(bool $execute = false)
	{
		$this->requestResult = $this->client->chat()->create([
			'model' => $this->getModel(),
			'messages' => [
				[
					'role' => 'user',
					'content' => $this->payload->getMessage()->getCleanText(),
//					'context' => 'neckita39',
				],
			],
		]);

		$message = '';
		foreach ($this->requestResult->choices as $result)
		{
			$message .= $result->message->content;
		}

		return $message;
	}
}