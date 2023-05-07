<?php

namespace App\Internal\Messenger\Telegram\Item;

use App\Internal\Messenger\Telegram\Bot\TelegramBot;
use App\Internal\Messenger\Telegram\Item\Command\AIImageCommand;
use App\Internal\Messenger\Telegram\Item\Command\AITextCommand;
use App\Internal\Messenger\Telegram\Item\Command\DefaultCommand;
use App\Internal\Messenger\Telegram\Item\Command\HelpCommand;
use App\Internal\Messenger\Telegram\Item\Command\ThanksCommand;
use App\Internal\Messenger\Telegram\Message;

class TelegramMessage implements Message
{
	private TelegramCommand $command;

	public function __construct(
		private readonly string $text,
	)
	{
		$this->command = $this->resolveCommand();
	}

	public function getText(bool $toLower = true): string
	{
		return $toLower ? mb_strtolower($this->text) : $this->text;
	}

	public function getCommand(): TelegramCommand
	{
		return $this->command;
	}

	private function resolveCommand(): TelegramCommand
	{
		$messageText = $this->getText();
		foreach ($this->getSupportedCommands() as $command) {
			if (str_contains($messageText, $command->getText())) {
				return $command;
			}
		}

		return new DefaultCommand();
	}

	/** @return TelegramCommand[] */
	private function getSupportedCommands(): array
	{
		return [
			(new AITextCommand()),
			(new AIImageCommand()),
			(new HelpCommand()),
			(new ThanksCommand()),
		];
	}

	public function getCleanText(): string
	{
		$result = $this->getText();

		$bot = TelegramBot::getInstance();
		$result = str_replace($bot->getName(), '', $result);

		$textCommands = array_map(static fn(TelegramCommand $command): string => $command->getText(), $this->getSupportedCommands());
		foreach ($textCommands as $textCommand)
		{
			$result = str_replace($textCommand, '', $result);
		}

		return $result;
	}
}