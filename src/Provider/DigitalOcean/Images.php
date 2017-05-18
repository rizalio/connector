<?php 

namespace Connector\Provider\DigitalOcean;

use Connector\Exception\nullParamException;
use Connector\Exception\responseErrorException;
use GuzzleHttp\Client;

class Images 
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
	 * List all images
	 * 
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#list-all-images
	 */

	public function getAll($perpage = 50,$page = 1)
	{
		$res = $this->http->request('GET','images?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();
	}

	/** 
	 * List all distribution images
	 * 
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#list-all-distribution-images
	 */

	public function getDistributionImages($perpage = 50,$page = 1)
	{
		$res = $this->http->request('GET','images?page=' . $page . '&per_page=' . $perpage . '&type=distribution');
		return $res->getBody()->getContents();
	}

	/** 
	 * List all application images
	 * 
	 * @return JSON
	 * Reference : https://developers.digitalocean.com/documentation/v2/#list-all-application-images
	 */

	public function getApplicationImages($perpage = 50,$page = 1)
	{
		$res = $this->http->request('GET','images?page=' . $page . '&per_page=' . $perpage . '&type=application');
		return $res->getBody()->getContents();
	}

	/** 
	 * List all user/private images
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function getUserImages($perpage = 50,$page = 1)
	{
		$res = $this->http->request('GET','images?page=' . $page . '&per_page=' . $perpage . '&type=private');
		return $res->getBody()->getContents();
	}

	/** 
	 * List all images action by id
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function getImagesActions($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}
		$res = $this->http->request('GET','images/' . $id . '/actions');
		return $res->getBody()->getContents();
	}

	/** 
	 * Get images by id
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function getImageById($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}
		$res = $this->http->request('GET','images/' . $id);
		return $res->getBody()->getContents();
	}

	/** 
	 * Get images by slug
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function getImageBySlug($slug = null)
	{
		if(null == $slug)
		{
			throw new nullParamException("Parameter Needed!");
		}
		$res = $this->http->request('GET','images/' . $slug);
		return $res->getBody()->getContents();
	}

	/** 
	 * Update image name
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function updateImageName($name = null,$id = null)
	{
		if(null == $name)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('PUT','images/' . $id,['json' => ['name' => $name]]);
		return $res->getBody()->getContents();
	}

	/** 
	 * Delete image
	 * 
	 * @return JSON
	 * Reference : 
	 */

	public function deleteImage($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('DELETE','images/' . $id);
		return $res->getBody()->getContents();
	}

	/**
	 * Transfer Image
	 *
	 * @return JSON
	 * Reference : 
	 */

	public function transfer($id = null, $image = null,$region = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $image)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == region)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','images/' . $id . '/actions', ['json' => ['type' => 'transfer','region' => $region]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Convert image to snapshots
	 *
	 * @return JSON
	 * Reference : 
	 */

	public function convert($id = null,$image = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $image)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST', 'images/' . $id . '/actions', ['json' => ['type' => 'convert']]);
		return $res->getBody()->getContents();
	}

	
}