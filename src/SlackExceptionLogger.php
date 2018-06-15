<?php

namespace SlackExceptionLogger;
use SlackMessenger\SlackMessenger;

class SlackExceptionLogger{
	public function log($url, $exception){
		$code = $exception->getCode();
		if (isset($_SERVER['REQUEST_URI'])){
			$url = env("APP_URL") . $_SERVER['REQUEST_URI'];
			$exceptionMessage = $exception->getMessage();
			$file = $exception->getFile();
			$line = $exception->getLine();
			if ($code != 404 and env("LOG_EXCEPTIONS", true) == true){
				$message = "\n*An exception occurred on* $url (" . $_SERVER['REQUEST_METHOD'] . ")\n\n
				```$exceptionMessage```\n
				*File:* `$file`\n*
				Line:* `$line`\n";

				(new SlackMessenger)->send($url, $message);
			}
		}
	}
}