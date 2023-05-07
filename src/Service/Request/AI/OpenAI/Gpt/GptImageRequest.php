<?php

namespace App\Service\Request\AI\OpenAI\Gpt;

class GptImageRequest extends GptRequest
{

	public function send(bool $execute = false)
	{
		$this->requestResult = $this->client->images()->create([
			'prompt' => $this->payload->getMessage()->getCleanText(),
		]);

		$message = '';
		foreach ($this->requestResult->data as $result)
		{
			$message .= $result->url;
		}

		return $message;
	}
}