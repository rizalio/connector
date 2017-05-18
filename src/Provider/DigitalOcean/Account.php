<?php 

namespace Connector\Provider\DigitalOcean;

use GuzzleHttp\Client;

class Account
{
	
	/**
	 * HTTP Wrapper
	 *
	 * @var $http
	 * @return JSON
	 */

	protected $http;

	public function __construct($http)
	{
		$this->http = $http;
		return $this->account();
	}

	/**
	 * Get Account information.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#get-user-information
	 */

	public function account()
	{
		$res = $this->http->request('GET','account');
		return $res->getBody()->getContents();
	}


}