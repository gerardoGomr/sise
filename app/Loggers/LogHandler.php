<?php
namespace Sise\Loggers;

/**
*
*/
class LogHandler
{
	private $log;

	private $logRepositorio;

	private static $instance;

	private function __construct(Log $log, LogsRepositorioInterface $logRepositorio)
	{
	}

	public function setLog(Log $log)
	{
		$this->log = $log;
	}

	public function setRepositorio(LogsRepositorioInterface $logRepositorio)
	{
		$this->logRepositorio = $logRepositorio;
	}

	public static function getInstance()
	{
		if(is_null(self::$instance)) {
			self::$instance = new LogHandler();
		}

		return self::$instance;
	}

	public function registrarLog()
	{
		$this->logRepositorio->persistir($log);
	}
}