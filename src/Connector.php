<?php 

namespace Connector;

use Provider\DigitalOcean;
use Provider\Vultr;
use Provider\Linode;
use Exception\invalidProviderException;

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
			throw new invalidProviderException("Provider " . $this->provider . " is not allowed!");
			
		}

		if($this->provider == 'digitalocean')
		{
			$this->provider = 'DigitalOcean';
		}

		return $this->formatProvider($this->provider);
	}

	/**
	 * Format the provider name with ucfirst()
	 *
	 * @param string $provider
	 * @return setProvider() method.
	 */

	public function formatProvider($provider)
	{
		$this->provider = ucfirst($provider);

		return $this->setProvider();
	}

	/**
	 * Initialize the Provider Class.
	 *
	 * @param string $this->apiKey
	 * @return Object
	 */

	public function setProvider()
	{
		return new $this->provider($this->apiKey);
	}


}