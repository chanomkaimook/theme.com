<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Caching
{
	public $name = "";
	public $ci = "";

	public function __construct()
	{
		//=	 call database	=//
		$this->ci = &get_instance();
		$this->ci->load->database();
		//===================//
		$this->ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}

	public function get(string $var = "")
	{
		$name = $var;
		$result = $this->ci->cache->get($name);
		return $result;
	}

	public function save(string $var = "", mixed $data)
	{
		$name = $var;
		$result = $this->ci->cache->save($name, $data);
		return $result;
	}

	public function info()
	{

		$result = $this->ci->cache->cache_info();
		return $result;
	}

	public function clean()
	{

		$result = $this->ci->cache->clean();
		return $result;
	}

	public function delete(string $var = "")
	{
		$name = $var;
		$result = $this->ci->cache->delete($name);
		return $result;
	}
}