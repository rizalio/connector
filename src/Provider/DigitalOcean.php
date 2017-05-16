<?php

namespace Connector\Provider;

use GuzzleHttp\Client;

class DigitalOcean
{
	public function __construct($apiKey)
	{
		return $apiKey;
	}
}