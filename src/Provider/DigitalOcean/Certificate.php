<?php 

namespace Connector\Provider\DigitalOcean;

use Connector\Exception\nullParamException;
use Connector\Exception\responseErrorException;
use GuzzleHttp\Client;

class Ceritificate 
{

	/**
	 * HTTP Wrapper
	 *
	 * @var $http
	 * @return JSON
	 * Reference : 
	 */

	protected $http;

	public function __construct($http)
	{
		$this->http = $http;
	}

	/**
	 * Create new certificate.
	 *
	 * @return JSON
	 */

	public function create($name,$cert,$leaf_cert,$chain_cert)
	{
		$data = [
			'name' => $name,
			'private_key' => $cert,
			'leaf_certificate' => $leaf_cert,
			'certificate_chain' => $chain_cert
		];
		$res = $this->http->request('POST', 'certificates', ['json' => $data]);
		return $res->getBody()->getContents();
	}

	/**
	 * Retrieve an existing certificate.
	 *
	 * @return JSON
	 */

	public function get($certId)
	{
		$res = $this->http->request('GET', 'certificates/' . $certId);
		return $res->getBody()->getContents();
	}

	

}