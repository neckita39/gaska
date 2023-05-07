<?php

namespace App\Resolve\Messenger;

use App\Internal\Messenger\Telegram\MessageData;
use Symfony\Component\HttpFoundation\Request;

interface Resolver
{
	public function resolve(Request $request): MessageData;
}