<?php

namespace App\Internal\Messenger\Telegram;


interface MessageData
{
	public function getChat(): Chat;
	public function getMessage(): Message;
	public function getUser(): User;
}