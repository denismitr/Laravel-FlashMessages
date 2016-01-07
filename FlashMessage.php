<?php namespace App\Http;

/**
*	Copyright 2016 by Denis Mitrofanov
*/

use League\Flysystem\Exception;

class FlashMessage
{

	protected $dislocation = 'flash_message';
	protected $title;
	protected $message;

	/**
	 * @var array
	 */
	protected static $dislocationMap = [
		'flash' => 'flash_message',
		'aside' => 'flash_message_aside',
		'overlay' => 'flash_message_overlay'
	];


	protected static $typeMap = [
		'warning',
		'error',
		'success',
		'info'
	];


	/**
	 * @param $name
	 * @param $arguments
	 * @return static
	 * @throws Exception
	 */
	public static function __callStatic($name, $arguments)
	{
		if ( ! isset(static::$dislocationMap[$name]) ) {
			throw new Exception("Wrong argument passed to FlashMessage class!");
		} else if (count($arguments) < 2) {
			throw new Exception("Wrong amount of argument passed to FlashMessage class!");
		}

		$title = isset($arguments[0]) ? $arguments[0] : '';
		$message = isset($arguments[1]) ? $arguments[1] : '';

		return new static(static::$dislocationMap[$name], $title, $message);
	}

	/**
	 * FlashMessage constructor.
	 * @param $dislocation
	 * @param $title
	 * @param $message
	 */
	private function __construct($dislocation, $title, $message)
	{
		if (!empty($dislocation))
		{
			$this->dislocation = $dislocation;
			$this->title = $title;
			$this->message = $message;
		}
	}


	/**
	 * @param string $type
	 */
	public function message($type = 'info')
	{
		session()->flash($this->dislocation, [
			'title' => $this->title,
			'message' => $this->message,
			'type' => $type
		]);
	}


	/**
	 * @param $type
	 * @param $arguments
	 * @throws Exception
	 */
	public function __call($type, $arguments)
	{

		if ( ! in_array($type, static::$typeMap)) {
			throw new Exception("Invalid message type!");
		}

		$this->message($type);
	}

}