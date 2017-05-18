<?php

namespace Connector\Provider;

use Connector\Provider\DigitalOcean\Account;
use Connector\Provider\DigitalOcean\Server;
use Connector\Provider\DigitalOcean\Images;
use Connector\Provider\DigitalOcean\Snapshots;
use Connector\Provider\DigitalOcean\Domains;
use GuzzleHttp\Client;

class DigitalOcean
{
	
	/**
	 * Base URL Endpoint for DigitalOcean API
	 *
	 * @var string $endpoint
	 */

	protected $endpoint = 'https://api.digitalocean.com/v2/';

	/**
	 * API Key for Authorization
	 *
	 * @var string $apiKey
	 */

	protected $apiKey;

	/**
	 * HTTP Wrapper.
	 *
	 * @var string $http
	 * @return \GuzzleHttp\Client Object
	 */

	protected $http;

	public function __construct($apiKey)
	{
		$this->apiKey = $apiKey;
		$this->http = new Client([
			'base_uri' => $this->endpoint,
			'headers' => [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $this->apiKey,
			]
		]);
	}

	/**
	 * Account
	 *
	 * @return Account Functionality
	 */

	public function account()
	{
		return new Account($this->http);
	}

	/**
	 * Server
	 *
	 * @return Server Functionality
	 */

	public function server()
	{
		return new Server($this->http);
	}

	/**
	 * Images
	 *
	 * @return Images Functionality
	 */

	public function images()
	{
		return new Images($this->http);
	}

	/**
	 * Snapshots
	 *
	 * @return Snapshots Functionality
	 */

	public function snapshots()
	{
		return new Snapshots($this->http);
	}

	/**
	 * Domains
	 *
	 * @return Domains Functionality
	 */

	public function domains()
	{
		return new Domains($this->http);
	}
}