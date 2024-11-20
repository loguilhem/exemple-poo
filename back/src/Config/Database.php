<?php

namespace Gri\Acme\Config;

use PDO;
use PDOException;

class Database
{
    private static $instance = NULL;
 
	public static function getInstance() {
		if(self::$instance === null) {
			try {
				self::$instance = new PDO('mysql:host=127.0.0.1:3306;dbname=acme','root','test');
			}

			catch(PDOException $e) {
				print "Erreur PDO ! : " . $e->getMessage() . "<br/>";

				die();
			}
		}

		return self::$instance;
	}
}
