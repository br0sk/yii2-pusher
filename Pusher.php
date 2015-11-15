<?php
namespace br0sk\pusher;

use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * This comopnent enables you to use Pusher in yii2.
 */ 
class Pusher extends Component
{
	private $_pusher	= null;
	
	public $appId 	= null;
	public $appKey 	= null;
	public $appSecret = null;
	
	private $_selectableOptions = ['host', 'port', 'timeout', 'encrypted'];
	
	public $options = [];

	public function init()
	{
		parent::init();
				
		//Mandatory config parameters
		if (!$this->appId) {
			throw new InvalidConfigException('AppId cannot be empty!');
		}
		if (!$this->appKey) {
			throw new InvalidConfigException('AppKey cannot be empty!');
		}
		if (!$this->appSecret) {
			throw new InvalidConfigException('AppSecret cannot be empty!');
		}
		
		foreach($this->options AS $key => $value) {
			if(in_array($key, $this->_selectableOptions) === false) {
				throw new InvalidConfigException($key .' is not a valid option!');				
			} 
		}
		
		//Create a new Pusher object if it hasn't already been created
		if ($this->_pusher === null) {
			$this->_pusher = new \Pusher( $this->appKey, $this->appSecret, $this->appId, $this->options);
		}
	}
	
	/**
	 * Proxy the calls to the Pusher object if the methods doesn't explixitly exist in this class.
	 * 
	 * If the method called is not found in the Pusher Object continue with standard Yii behaviour
	 */ 
	public function __call($method, $params)
	{
		//Override the normal Yii functionality checking the Keen SDK for a matching method
		if (method_exists($this->_pusher, $method)) {
			return call_user_func_array(array($this->_pusher, $method), $params);
		}
		
		//Use standard Yii functionality, checking behaviours
		return parent::__call($method, $params);
	}
	
	/**
	 * Trigger an event by providing event name and payload. 
	 * Optionally provide a socket ID to exclude a client (most likely the sender).
	 *
	 * Overriding this method to deal with clash with base class trigger method. 
	 * 
	 * @param array $channels An array of channel names to publish the event on.
	 * @param string $event
	 * @param mixed $data Event data
	 * @param int $socket_id [optional]
	 * @param bool $debug [optional]
	 * @return bool|string
	 */
	public function trigger( $channels, $event, $data, $socket_id = null, $debug = false, $already_encoded = false )
	{
		$this->_pusher->trigger( $channels, $event, $data, $socket_id, $debug, $already_encoded);
	}
}
