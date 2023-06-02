<?php

namespace Helpers;

class HTTP
{
	static $base = "http://localhost/app";

	static function redirect($path, $q = "")
	{
		$url = static::$base . $path;
		if($q) $url .= "?$q";

		header("location: $url");
		exit();
	}
}
