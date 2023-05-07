<?php

namespace App\Service\Request\Messenger\Telegram\Payload;

use App\Internal\AI\OpenAI\Gpt;
use App\Internal\Messenger\Telegram\Item\Command\AIImageCommand;
use App\Internal\Messenger\Telegram\Item\Command\AITextCommand;
use App\Internal\Messenger\Telegram\Item\Command\HelpCommand;
use App\Internal\Messenger\Telegram\Item\Command\ThanksCommand;
use App\Internal\Messenger\Telegram\MessageData;
use App\Service\Request\AI\OpenAI\Gpt\GptImageRequest;
use App\Service\Request\AI\OpenAI\Gpt\GptTextRequest;
use App\Service\Request\Messenger\Telegram\Payload\Message\DefaultMessage;
use App\Service\Request\Messenger\Telegram\Payload\Message\HelpMessage;
use App\Service\Request\Messenger\Telegram\Payload\Message\ThanksMessage;

class PayloadFactory
{
	public static function getPayload(MessageData $resolvedData): TelegramPayloadCollection
	{
		$payloads = new TelegramPayloadCollection();
		$command = $resolvedData->getMessage()->getCommand()::class;
		switch ($command)
		{
			case AITextCommand::class:
				$gpt = Gpt::getInstance();
				$result = (new GptTextRequest($gpt, $resolvedData))->send();
				$payloads->add(new TelegramTextPayload($result));
				break;

			case AIImageCommand::class:
				$gpt = Gpt::getInstance();
				$result = (new GptImageRequest($gpt, $resolvedData))->send();
				$payloads->add(new TelegramImagePayload($result));
				break;

			case HelpCommand::class:
				$result = (new HelpMessage())->getText();
				$payloads->add(new TelegramTextPayload($result));
				break;

			case ThanksCommand::class:
				$result = (new ThanksMessage())->getText();
				$payloads->add(new TelegramTextPayload($result));
				break;

			default:
				$result = (new DefaultMessage())->getText();
				$payloads->add(new TelegramTextPayload($result));
				break;
		}

		return $payloads;
	}
}