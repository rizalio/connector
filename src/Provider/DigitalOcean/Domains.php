<?php 

namespace Connector\Provider\DigitalOcean;

use Connector\Exception\nullParamException;
use Connector\Exception\responseErrorException;
use GuzzleHttp\Client;

class Domains 
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
	 * Get all domain from account.
	 *
	 * @return JSON
	 * Reference :  https://developers.digitalocean.com/documentation/v2/#list-all-domains
	 */

	public function getAll()
	{
		$res = $this->http->request('GET','domains');
		return $res->getBody()->getContents();
	}

	/**
	 * Create new domain.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#create-a-new-domain 
	 */

	public function create($domain,$ip)
	{
		$res = $this->http->request('POST','domains', ['json' => ['name' => $domain, 'ip_address' => $ip]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Get an existing domain.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#retrieve-an-existing-domain 
	 */

	public function get($domain)
	{
		$res = $this->http->request('GET', 'domains/' . $domain);
		return $res->getBody()->getContents();
	}

	/**
	 * Delete domain.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#delete-a-domain
	 */

	public function delete($domain)
	{
		$res = $this->http->request('DELETE', 'domains/' . $domain);
		return $res->getBody()->getContents();
	}

	/**
	 * Get all domain record.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#list-all-domain-records
	 */

	public function getRecords($domain)
	{
		$res = $this->http->request('GET', 'domains/' . $domain . '/records');
		return $res->getBody()->getContents();
	}

	/**
	 * Create domain record.
	 * 
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#create-a-new-domain-record
	 */

	public function createRecords($domain,$type,$name,$data,$ttl = 1800,$priority = false,$port = false)
	{
		$record = [
			'type' => $type, // A, AAA, NS, CNAME, TXT, SRV
			'name' => $name, // record name (ex: www s1)
			'data' => $data, // Remote IP or remote domain
			'ttl' => $ttl,
			'priority' => $priority,
			'port' => $port
		];
		$res = $this->http->request('POST','domains/' . $domain . '/records', ['json' => $record]);
		return $res->getBody()->getContents();
	}

	/**
	 * Get each record details
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#retrieve-an-existing-domain-record
	 */

	public function getRecordDetails($domain,$idRecord)
	{
		$res = $this->http->request('GET', 'domains/' . $domain . '/records/' . $idRecord);
		return $res->getBody()->getContents();
	}

	/**
	 * Update domain record.
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#update-a-domain-record
	 */

	public function updateRecords($domain,$idRecord, $type,$name,$data,$ttl = 1800,$priority = false,$port = false)
	{
		$record = [
			'type' => $type, // A, AAA, NS, CNAME, TXT, SRV
			'name' => $name, // record name (ex: www s1)
			'data' => $data, // Remote IP or remote domain
			'ttl' => $ttl,
			'priority' => $priority,
			'port' => $port
		];
		$res = $this->http->request('PUT', 'domains/' . $domain . '/records/' . $idRecord, ['json' => $record]);
		return $res->getBody()->getContents();
	}

	/**
	 * Delete domain record
	 *
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#retrieve-an-existing-domain-record
	 */

	public function deleteRecords($domain,$idRecord)
	{
		$res = $this->http->request('DELETE','domains/' . $domain . '/records/' . $idRecord);
		return $res->getBody()->getContents();
	}


}