<?php 

namespace Connector\Provider\DigitalOcean;

use Connector\Exception\nullParamException;
use Connector\Exception\responseErrorException;
use GuzzleHttp\Client;

class Server
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
	 * Get all server
	 *
	 * @return JSON
	 */

	public function getAll($perpage = 50,$page = 1)
	{
		$res = $this->http->request('GET','droplets?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();
	}

	/**
	 * Get existing server by id.
	 *
	 * @return JSON
	 */

	public function getById($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id);
		return $res->getBody()->getContents();

	}

	/**
	 * Get existing server by tag.
	 *
	 * @return JSON
	 */

	public function getByTag($tag = null)
	{
		if(null == $tag)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets?tag_name=' . $tag);
		return $res->getBody()->getContents();
	}

	/**
	 * Get existing server by id.
	 *
	 * @return JSON
	 */

	public function availableKernel($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id . '/kernels?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();

	}

	/**
	 * Get list snapshots for server.
	 *
	 * @return JSON
	 */

	public function getSnapshots($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id . '/snapshots?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();
	}

	/**
	 * Get list backups for server.
	 *
	 * @return JSON
	 */

	public function getBackups($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id . '/backups?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();
	}

	/**
	 * Get list snapshots for server.
	 *
	 * @return JSON
	 */

	public function getActions($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id . '/actions?page=' . $page . '&per_page=' . $perpage);
		return $res->getBody()->getContents();
	}

	/**
	 * Delete Server.
	 *
	 * @return JSON
	 */

	public function delete($id = null,$perpage = 50,$page = 1)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('DELETE','droplets/' . $id);
		return $res->getBody()->getContents();
	}

	/**
	 * Delete Server by tag.
	 *
	 * @return JSON
	 */

	public function deleteByTag($tag = null,$perpage = 50,$page = 1)
	{
		if(null == $tag)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('DELETE','droplets/?tag_name' . $tag);
		return $res->getBody()->getContents();
	}

	/**
	 * Get neighbors for server
	 *
	 * @return JSON
	 */

	public function getNeighbors($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('GET','droplets/' . $id . '/neighbors');
		return $res->getBody()->getContents();
	}

	/**
	 * Get neighbors for all server
	 *
	 * @return JSON
	 */

	public function getAllNeighbors()
	{
		$res = $this->http->request('GET','reports/droplet_neighbors');
		return $res->getBody()->getContents();
	}

	/**
	 * Create new server
	 *
	 * @return JSON
	 */

	public function create($name,$region,$size,$image,$ssh = null,$backup = false,$user_data = null,$private_networking = null,$ipv6 = false,$tag = [],$volumes = null)
	{
		$data = [
			'name' => $name,
			'region' => $region,
			'size' => $size,
			'image' => $image,
			'ssh_keys' => $ssh,
			'backups' => $backup,
			'ipv6' => $ipv6,
			'volumes' => $volumes
		];

		$res = $this->http->request('POST', 'droplets', ['json' => $data]);
		return $res->getBody()->getContents();
	}

	/**
	 * Enable backups.
	 *
	 * @return JSON
	 */

	public function enableBackups($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'enable_backups']]);
		return $res->getBody()->getContents();
	}

	/**
	 * Disable backups.
	 *
	 * @return JSON
	 */

	public function disableBackups($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'disable_backups']]);
		return $res->getBody()->getContents();
	}

	/**
	 * Reboot server.
	 *
	 * @return JSON
	 */

	public function reboot($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'reboot']]);
		return $res->getBody()->getContents();
	}

	/**
	 * PowerCycle server.
	 *
	 * @return JSON
	 */

	public function powerCycle($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'power_cycle']]);
		return $res->getBody()->getContents();
	}

	/**
	 * ShutDown server.
	 *
	 * @return JSON
	 */

	public function shutDown($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'shutdown']]);
		return $res->getBody()->getContents();
	}

	/**
	 * PowerOff server.
	 *
	 * @return JSON
	 */

	public function powerOff($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'power_off']]);
		return $res->getBody()->getContents();
	}

	/**
	 * PowerOn server.
	 *
	 * @return JSON
	 */

	public function powerOn($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'power_on']]);
		return $res->getBody()->getContents();
	}

	/**
	 * Restore server.
	 *
	 * @return JSON
	 */

	public function restore($id = null,$imageId = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $imageId)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'restore', 'image' => $imageId]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Reset Password server.
	 *
	 * @return JSON
	 */

	public function resetPassword($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'password_reset']]);
		return $res->getBody()->getContents();
	}

	/**
	 * Resize server.
	 *
	 * @return JSON
	 */

	public function resize($id = null,$size = null,$disk = true)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $size)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'resize', 'disk' => $disk, 'size' => $size]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Rebuild server.
	 *
	 * @return JSON
	 */

	public function rebuild($id = null,$image = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $image)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'rebuild', 'image' => $image]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Rename server.
	 *
	 * @return JSON
	 */

	public function rename($id = null,$name = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $image)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'rename', 'name' => $name]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Change server Kernel.
	 *
	 * @return JSON
	 */

	public function changeKernel($id = null,$kernel = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $kernel)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'change_kernel', 'kernel' => $kernel]]);
		return $res->getBody()->getContents();
	}

	/**
	 * Enable server ipv6.
	 *
	 * @return JSON
	 */

	public function enableIpv6($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'enable_ipv6']]);
		return $res->getBody()->getContents();
	}

	/**
	 * Enable server private networking.
	 *
	 * @return JSON
	 */

	public function enablePrivateNetworking($id = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'enable_private_networking']]);
		return $res->getBody()->getContents();
	}


	/**
	 * Snapshots server.
	 *
	 * @return JSON
	 */

	function snapshots($id = null, $name = null)
	{
		if(null == $id)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $name)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/' . $id . '/actions', ['json' => ['type' => 'snapshots', 'name' => $name]]);
		return $res->getBody()->getContents();
	}

	/** 
	 * Act server by tag.
	 *
	 * @return JSON
	 * Allowed Type :
	 *	- power_cycle
	 *	- power_on
	 *	- power_off
	 *	- shutdown
	 *	- enable_private_networking
	 *	- enable_ipv6
	 *	- enable_backups
	 *	- disable_backups
	 *	- snapshot
	 */

	public function actByTag($tag = null,$type = null)
	{
		if(null == $tag)
		{
			throw new nullParamException("Parameter Needed!");
		}

		if(null == $type)
		{
			throw new nullParamException("Parameter Needed!");
		}

		$res = $this->http->request('POST','droplets/actions?tag_name=' . $tag, ['json' => ['type' => $type]]);
		return $res->getBody()->getContents();
	}
}