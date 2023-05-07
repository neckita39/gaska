<?php

namespace App\Service\Request\Messenger\Telegram\Payload\Message;

class HelpMessage implements Message
{
	public function getText(): string
	{
		return
			'Вот список доступных команд:' . "\n"
			. '%bot_name% ai text ваше_сообщение - пообщаться с ChatGPT' . "\n"
			. '%bot_name% ai image ваше_сообщение - сгенирировать картинку с помощью DALL-E' . "\n"
			. '%bot_name% thanks - сказать спасибо' . "\n"
			. '%bot_name% ваше_сообщение - получить предложение махнуть по 50 грамм' . "\n";
	}
}