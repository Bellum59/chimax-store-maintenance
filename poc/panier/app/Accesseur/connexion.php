<?php
namespace App\Accesseur;
use PDO;
class BaseDeDonnees
{
    public $pdo;

	function __construct()
	{
		try
        {
            $dsn = $dsn = 'mysql:dbname=chimax;host=localhost';
            $usager = 'root';
            $motdepasse = '';
            $this->pdo = new PDO($dsn, $usager, $motdepasse);
        }
        catch(PDOException $exception)
        {
            echo $exception->getMessage();
        }
	}

}

?>