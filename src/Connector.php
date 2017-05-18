<?php 

namespace Connector;

use \Connector\Provider\DigitalOcean;
use \Connector\Provider\Vultr;
use \Connector\Provider\Linode;
use \Connector\Exception\notAllowedProviderException;


class Client 
{

	/**
	 * Define provider.
	 *
	 * @var string
	 */

	protected $provider;

	/**
	 * Define the API Key for the provider.
	 *
	 * @var string $apiKey
	 */

	protected $apiKey;

	/**
	 * List allowed provider.
	 *
	 * @var array $allowedProvider
	 */

	protected $allowedProvider = [
		'vultr','digitalocean','linode'
	];

	/**
	 * Result Handler
	 *
	 * @var $handler
	 * @return JSON
	 */

	public $get;

	/**
	 * Set provider.
	 *
	 * @param string $provider
	 * @return mixed
	 */

	public function __construct($provider,$apiKey)
	{
		$this->provider = strtolower($provider);
		$this->apiKey = $apiKey;

		if(!in_array($provider,$this->allowedProvider))
		{
			throw new notAllowedProviderException("Provider " . $this->provider . " is not allowed!");
			
		}

		return $this->setProvider($this->provider);
	}

	/**
	 * Initialize the Provider Class.
	 *
	 * @param string $this->apiKey
	 * @return Object
	 */

	public function setProvider()
	{
		switch ($this->provider) {
			case 'digitalocean':
				return $this->run(DigitalOcean::class,$this->apiKey);
				break;
			case 'vultr':
				return $this->run(Vultr::class,$this->apiKey);
				break;
			case 'linode':
				return $this->run(Linode::class,$this->apiKey);
				break;
			default:
				throw new notAllowedProviderException("Provider " . $this->provider . " not allowed!");
				break;
		}
	}

	/**
	 * Run!
	 *
	 * @return Object
	 */

	public function run($provider,$apiKey)
	{
		return $this->get = new $provider($apiKey);
	}

}