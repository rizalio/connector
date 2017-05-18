<?php 

namespace Connector\Provider\DigitalOcean;

use Connector\Exception\nullParamException;
use Connector\Exception\responseErrorException;
use GuzzleHttp\Client;

class Snapshots 
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
	}

	/**
	 * List all snapshots.
	 *
	 * @return JSON 
	 */

	public function getAll($page = 1,$perpage = 50)
	{
		$res = $this->http->request('GET', 'snapshots?per_page=' . $perpage . '&page=' . $page);
		return $res->getBody()->getContents();
	}

	/**
	 * List all server snapshots.
	 *
	 * @return JSON 
	 */

	public function getServerSnapshot($page = 1,$perpage = 50)
	{
		$res = $this->http->request('GET', 'snapshots?per_page=' . $perpage . '&page=' . $page);
		return $res->getBody()->getContents();
	}

}