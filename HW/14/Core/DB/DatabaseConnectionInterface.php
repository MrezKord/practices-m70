<?php

namespace Core\DB;

interface DatabaseConnectionInterface
{
	public static function getInstance();
	public static function config(array $config);
	public function getPDO();

}
