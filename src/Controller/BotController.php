<?php

namespace App\Controller;

use App\Internal\Messenger\Telegram\Bot\TelegramBot;
use App\Internal\Messenger\Telegram\MessageData;
use App\Repository\MessageRepository;
use App\Resolve\Messenger\Telegram\RequestResolver;
use App\Service\Message\MessageService;
use App\Service\Request\Messenger\Telegram\Payload\PayloadFactory;
use App\Service\Request\Messenger\Telegram\Payload\TelegramPayload;
use App\Service\Request\Messenger\Telegram\TelegramRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BotController extends AbstractController
{
	private MessageService $messageService;

	public function __construct(
		private readonly HttpClientInterface $client,
		private readonly MessageRepository   $messageRepository
	)
	{
	}

	#[Route('/bot')]
	public function resolve(Request $request,): Response
	{
		$resolvedData = (new RequestResolver())->resolve($request);
		if ($this->notForMe($resolvedData)) {
			return new JsonResponse('Not for me.');
		}

		$payloads = PayloadFactory::getPayload($resolvedData);
		if ($payloads->isEmpty()) {
			return new JsonResponse('Empty payloads.');
		}

		try {
			$this->messageService = new MessageService($this->messageRepository, $resolvedData);
			$this->messageService->add();
		} catch (\Exception $exception) {
			return new JsonResponse($exception->getMessage());
		}


		foreach ($payloads as $payload) {
			/** @var TelegramPayload $payload */
			$request = new TelegramRequest($resolvedData, $payload, $this->client);
			$request->send();
		}


		return new JsonResponse($payloads->toArray());
	}

	private function notForMe(MessageData $messageData): bool
	{
		return !str_contains(
			$messageData->getMessage()->getText(),
			TelegramBot::getInstance()->getName()
		);
	}
}