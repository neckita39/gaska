<?php

namespace App\Service\Message;

use App\Entity\Message;
use App\Internal\Messenger\Telegram\Bot\TelegramBot;
use App\Internal\Messenger\Telegram\MessageData;
use App\Repository\MessageRepository;

class MessageService
{
	public function __construct(
		private readonly MessageRepository $repository,
		private readonly MessageData $messageData
	)
	{
	}

	public function add(): self
	{
		$text = $this->messageData->getMessage()->getCleanText();
		$message = new Message();
		$message
			->setMessage($text)
			->setUser($this->messageData->getUser()->getLogin())
			->setChat($this->messageData->getChat()->getId())
			->setCreated(new \DateTime());

		$this->repository->save($message, true);
		return $this;
	}
}